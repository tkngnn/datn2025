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

class ThanhToanController extends Controller
{
    public function thanhToan($id)
    {
        $hoaDon = HoaDon::findOrFail($id);

        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');

        // Kiểm tra tồn tại các biến môi trường
        if (empty($vnp_TmnCode) || empty($vnp_HashSecret)) {
            throw new \Exception('Cấu hình VNPay chưa đầy đủ');
        }

        $vnp_TxnRef = $hoaDon->ma_hoa_don . '_' . time(); // Mã giao dịch
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

        // Sắp xếp theo key
        ksort($inputData);

        // Tạo query và hash data
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
        // Log dữ liệu gửi đi để debug
        Log::info('VNPay Payment URL: ', [
            'inputData' => $inputData,
            'hashData' => $hashdata,
            'secureHash' => $vnpSecureHash,
            'finalUrl' => $vnp_Url
        ]);

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
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
            // Kiểm tra mã phản hồi từ VNPAY
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Lấy mã giao dịch và mã hóa đơn
                $txnRef = $inputData['vnp_TxnRef'];
                $hoaDon = HoaDon::where('ma_hoa_don', $txnRef)->first();

                if ($hoaDon && $hoaDon->trang_thai !== 'da thanh toan') {
                    // Cập nhật trạng thái hóa đơn
                    $hoaDon->trang_thai = 'da thanh toan';
                    $hoaDon->save();

                    $this->sendPaymentSuccess($hoaDon->ma_hoa_don);

                    // Lưu thông tin vào bảng thanh_toan
                    ThanhToan::create([
                        'ma_hoa_don' => $hoaDon->ma_hoa_don,
                        'ma_giao_dich' => $inputData['vnp_TransactionNo'] ?? '',
                        'so_tien' => $inputData['vnp_Amount'] / 100, // VNPAY trả về x100 lần
                        'phuong_thuc' => $inputData['vnp_CardType'] ?? 'VNPAY',
                        'trang_thai' => 'thanh cong',
                        'thoi_gian' => Carbon::now(),
                        'noi_dung' => $inputData['vnp_OrderInfo'] ?? '',
                        'phan_hoi_tu_cong_thanh_toan' => json_encode($inputData),
                    ]);
                }

                return redirect()->route('kt.hoadon')->with('success', 'Thanh toán thành công!');
            } else {
                // ❗ Lưu giao dịch thất bại
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
