<?php

namespace App\Http\Controllers\Admin\KT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\HopDong;
use App\Models\HoaDon;
use App\Models\ThanhToan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\DB;

class ThanhToanController extends Controller
{
    public function thanhToan($id)
    {
        $hoaDon = HoaDon::findOrFail($id);

        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');

        if (empty($vnp_TmnCode) || empty($vnp_HashSecret)) {
            throw new \Exception('Cấu hình VNPay chưa đầy đủ');
        }

        $vnp_TxnRef = $hoaDon->ma_hoa_don . '_' . time(); 
        $vnp_OrderInfo = 'Thanh toan hoa don #' . $hoaDon->ma_hoa_don;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)($hoaDon->tong_tien * 100);
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        ksort($inputData);

        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        Log::info('VNPay Payment URL: ', [
            'inputData' => $inputData,
            'hashData' => $hashdata,
            'secureHash' => $vnpSecureHash,
            'finalUrl' => $vnp_Url
        ]);

        return redirect($vnp_Url);
    }

    /*public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = [];
        foreach ($request->input() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                $txnRef = $inputData['vnp_TxnRef'];
                $hoaDon = HoaDon::where('ma_hoa_don', $txnRef)->first();

                if ($hoaDon && $hoaDon->trang_thai !== 'da thanh toan') {
                    $hoaDon->trang_thai = 'da thanh toan';
                    $hoaDon->save();

                    $this->sendPaymentSuccess($hoaDon->ma_hoa_don);

                    ThanhToan::create([
                        'ma_hoa_don' => $hoaDon->ma_hoa_don,
                        'ma_giao_dich' => $inputData['vnp_TransactionNo'] ?? '',
                        'so_tien' => $inputData['vnp_Amount'] / 100, 
                        'phuong_thuc' => $inputData['vnp_CardType'] ?? 'VNPAY',
                        'trang_thai' => 'thanh cong',
                        'thoi_gian' => Carbon::now(),
                        'noi_dung' => $inputData['vnp_OrderInfo'] ?? '',
                        'phan_hoi_tu_cong_thanh_toan' => json_encode($inputData),
                    ]);
                }

                return redirect()->route('kt.hoadon')->with('success', 'Thanh toán thành công!');
            } else {
                ThanhToan::create([
                    'ma_hoa_don' => $inputData['vnp_TxnRef'],
                    'ma_giao_dich' => $inputData['vnp_TransactionNo'] ?? '',
                    'so_tien' => $inputData['vnp_Amount'] / 100,
                    'phuong_thuc' => $inputData['vnp_CardType'] ?? 'VNPAY',
                    'trang_thai' => 'that bai',
                    'thoi_gian' => Carbon::now(),
                    'noi_dung' => $inputData['vnp_OrderInfo'] ?? '',
                    'phan_hoi_tu_cong_thanh_toan' => json_encode($inputData),
                ]);
                return redirect()->route('kt.hoadon')->with('error', 'Thanh toán thất bại!');
            }
        } else {
            return redirect()->route('kt.hoadon')->with('error', 'Sai chữ ký xác minh!');
        }
    }*/
    public function vnpayReturn(Request $request)
    {
        try {
            Log::info('[VNPay Return] Request Data:', $request->all());

            $vnp_HashSecret = env('VNPAY_HASH_SECRET');
            $vnp_SecureHash = $request->input('vnp_SecureHash');
            $inputData = [];

            foreach ($request->all() as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }

            unset($inputData['vnp_SecureHash']);
            unset($inputData['vnp_SecureHashType']);

            ksort($inputData);
            $hashData = "";
            $i = 0;

            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }

            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

            if ($secureHash !== $vnp_SecureHash) {
                Log::error('[VNPay Return] Sai chữ ký xác thực', [
                    'expected' => $secureHash,
                    'received' => $vnp_SecureHash
                ]);
                return redirect()->route('kt.hoadon')->with('error', 'Chữ ký không hợp lệ!');
            }

            if ($inputData['vnp_TmnCode'] != env('VNPAY_TMN_CODE')) {
                Log::error('[VNPay Return] Sai mã website', [
                    'expected' => env('VNPAY_TMN_CODE'),
                    'received' => $inputData['vnp_TmnCode']
                ]);
                return redirect()->route('kt.hoadon')->with('error', 'Mã website không hợp lệ!');
            }

            $txnRef = $inputData['vnp_TxnRef'];
            $hoaDon = HoaDon::where('ma_hoa_don', $txnRef)->first();

            if (!$hoaDon) {
                ThanhToan::create([
                    'ma_hoa_don' => $txnRef,
                    'ma_giao_dich' => $inputData['vnp_TransactionNo'] ?? '',
                    'so_tien' => $inputData['vnp_Amount'] / 100,
                    'phuong_thuc' => $inputData['vnp_CardType'] ?? 'VNPAY',
                    'trang_thai' => 'that bai',
                    'thoi_gian' => Carbon::now(),
                    'noi_dung' => 'Hóa đơn không tồn tại',
                    'phan_hoi_tu_cong_thanh_toan' => json_encode($inputData),
                ]);

                Log::error('[VNPay Return] Hóa đơn không tồn tại', ['ma_hoa_don' => $txnRef]);
                return redirect()->route('kt.hoadon')->with('error', 'Hóa đơn không tồn tại!');
            }

            if (isset($inputData['vnp_Command']) && $inputData['vnp_Command'] == 'ipn') {
                return response()->json([
                    'RspCode' => '00',
                    'Message' => 'Confirm Success'
                ]);
            }

            if ($hoaDon->trang_thai === 'da thanh toan') {
                Log::warning('[VNPay Return] Hóa đơn đã thanh toán trước đó', ['ma_hoa_don' => $txnRef]);
                return redirect()->route('kt.hoadon')->with('warning', 'Hóa đơn đã được thanh toán trước đó!');
            }

            if ($inputData['vnp_ResponseCode'] == '00') {
                DB::transaction(function () use ($hoaDon, $inputData) {
                    $amount = $inputData['vnp_Amount'] / 100;
                    if ($amount != $hoaDon->tong_tien) {
                        throw new \Exception("Số tiền thanh toán không khớp");
                    }

                    $hoaDon->trang_thai = 'da thanh toan';
                    $hoaDon->save();

                    $this->sendPaymentSuccess($hoaDon->ma_hoa_don);

                    ThanhToan::create([
                        'ma_hoa_don' => $hoaDon->ma_hoa_don,
                        'ma_giao_dich' => $inputData['vnp_TransactionNo'] ?? '',
                        'so_tien' => $amount,
                        'phuong_thuc' => $inputData['vnp_CardType'] ?? 'VNPAY',
                        'trang_thai' => 'thanh cong',
                        'thoi_gian' => Carbon::now(),
                        'noi_dung' => $inputData['vnp_OrderInfo'] ?? '',
                        'phan_hoi_tu_cong_thanh_toan' => json_encode($inputData),
                    ]);

                    Log::info('[VNPay Return] Thanh toán thành công', [
                        'ma_hoa_don' => $hoaDon->ma_hoa_don,
                        'so_tien' => $amount
                    ]);
                });

                return redirect()->route('kt.hoadon')->with('success', 'Thanh toán thành công!');
            } else {
                ThanhToan::create([
                    'ma_hoa_don' => $hoaDon->ma_hoa_don,
                    'ma_giao_dich' => $inputData['vnp_TransactionNo'] ?? '',
                    'so_tien' => $inputData['vnp_Amount'] / 100,
                    'phuong_thuc' => $inputData['vnp_CardType'] ?? 'VNPAY',
                    'trang_thai' => 'that bai',
                    'thoi_gian' => Carbon::now(),
                    'noi_dung' => $inputData['vnp_OrderInfo'] ?? '',
                    'phan_hoi_tu_cong_thanh_toan' => json_encode($inputData),
                ]);

                Log::error('[VNPay Return] Thanh toán thất bại', [
                    'ma_hoa_don' => $hoaDon->ma_hoa_don,
                    'response_code' => $inputData['vnp_ResponseCode'],
                    'message' => $inputData['vnp_Message'] ?? ''
                ]);

                return redirect()->route('kt.hoadon')->with('error', 'Thanh toán thất bại: ' . ($inputData['vnp_Message'] ?? ''));
            }
        } catch (\Exception $e) {
            Log::error('[VNPay Return] Exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ma_hoa_don' => $txnRef ?? 'unknown'
            ]);

            return redirect()->route('kt.hoadon')->with('error', 'Đã xảy ra lỗi khi xử lý thanh toán!');
        }
    }

    public function sendPaymentSuccess($hoaDonId)
    {
        $hoaDon = HoaDon::with('hopDong.user')->where('ma_hoa_don', $hoaDonId)->firstOrFail();
        $thanhToan = ThanhToan::where('ma_hoa_don', $hoaDonId)->orderByDesc('thoi_gian')->first();

        $userEmail = optional($hoaDon->hopDong->user)->email;

        if ($userEmail) {
            Mail::to($userEmail)->send(new PaymentSuccessMail($hoaDon, $thanhToan));
        } else {
            Log::warning("Không tìm thấy email user cho hóa đơn ID: {$hoaDonId}");
        }
    }
}