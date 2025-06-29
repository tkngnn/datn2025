<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HoaDonSendMailer;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\HoaDon;
use App\Models\ToaNha;

class HoaDonController extends Controller
{
    public function index(Request $request)
    {
        $query = HoaDon::with(['hopdong.chiTietHopDongs.vanphong.toanha', 'hopdong.user'])
        ->whereNotNull('so_dien')
        ->whereNotNull('so_nuoc');

        if ($request->filled('ma_toa_nha')) {
            $query->whereHas('hopdong.chiTietHopDongs.vanphong.toanha', function ($q) use ($request) {
                $q->where('ma_toa_nha', $request->ma_toa_nha);
            });
        }

        // Lọc theo tháng năm
        if ($request->filled('thang_nam')) {
            $query->where('thang_nam', $request->thang_nam);
        }

        // Lọc theo tiền
        if ($request->filled('gia_thue_min')) {
            $query->where('tong_tien', '>=', (float) str_replace(',', '', $request->gia_thue_min));
        }

        if ($request->filled('gia_thue_max')) {
            $query->where('tong_tien', '<=', (float) str_replace(',', '', $request->gia_thue_max));
        }

        // Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $hoadons = $query->get();
        foreach($hoadons as $hoadon){
            if($hoadon->trang_thai==="chua thanh toan"){
                $hanDong = \Carbon\Carbon::parse($hoadon->thang_nam . '-01')->addMonth()->day(10);

                $soNgayQuaHan = now()->greaterThan($hanDong) ? (int) $hanDong->diffInDays(now()) : 0;

                $hoadon->so_ngay_qua_han = $soNgayQuaHan;
            }
        }

        $chuaThanhToan = HoaDon::where('trang_thai', 'chua thanh toan')
        ->where(function($query) {
            $query->whereNotNull('so_dien')->WhereNotNull('so_nuoc');
        })
        ->count();
        
        $dsToaNha=ToaNha::all();

        return view('admin.hoadon.index', compact('hoadons','chuaThanhToan','dsToaNha'));
    }

    public function preview($id)
    {
        $hoadon = HoaDon::with(['hopdong.chiTietHopDongs.vanphong.toanha', 'hopdong.user','hopdong.hoaDons'])->findOrFail($id);

        $hopdong = $hoadon->hopdong;
        $hoaDonHienTai = $hopdong->hoaDons->where('thang_nam', $hoadon->thang_nam ?? null)->first();

        if ($hoaDonHienTai) {
            $thangNamHienTai = $hoaDonHienTai->thang_nam;
            $thangNamTruoc = Carbon::parse($thangNamHienTai . '-01')->subMonth()->format('Y-m');
            $hoaDonThangTruoc = $hopdong->hoaDons->where('thang_nam', $thangNamTruoc)->first();

            $hoadon->chi_so_dien_cu = $hoaDonThangTruoc?->so_dien ?? 0;
            $hoadon->chi_so_nuoc_cu = $hoaDonThangTruoc?->so_nuoc ?? 0;
        } else {
            $hoadon->chi_so_dien_cu = 0;
            $hoadon->chi_so_nuoc_cu = 0;
        }
        
        return view('admin.hoadon.preview_hoadon', compact('hoadon'));
    }

    public function guiMail(Request $request)
    {
        $hoadon = HoaDon::with([
            'hopdong.user',
            'hopdong.chiTietHopDongs.vanPhong.toaNha'
        ])->findOrFail($request->ma_hoa_don);

        $thangTruoc = Carbon::parse($hoadon->thang_nam . '-01')->subMonth()->format('Y-m');
        \Log::info("$thangTruoc");
        $hoaDonTruoc = HoaDon::where('ma_hop_dong', $hoadon->ma_hop_dong)
                            ->where('thang_nam', $thangTruoc)
                            ->first();

        $soDienCu = $hoaDonTruoc?->so_dien ?? 0;
        $soNuocCu = $hoaDonTruoc?->so_nuoc ?? 0;

        Mail::to($hoadon->hopdong->user->email)->send(new HoaDonSendMailer($hoadon, $soDienCu, $soNuocCu));
        \Log::info("Đã gửi mail đến {$hoadon->hopdong->user->email}");

        return back()->with('success', "Đã gửi hóa đơn #{$request->ma_hoa_don} cho khách thuê {$hoadon->hopdong->user->name}.");
        }

        public function downloadPDF($id)
        {
            $hoadon = HoaDon::with([
                'hopdong.user',
                'hopdong.chiTietHopDongs.vanphong.toanha',
                'hopdong.hoaDons'
            ])->findOrFail($id);

            $hopdong = $hoadon->hopdong;
            $hoaDonHienTai = $hopdong->hoaDons->where('thang_nam', $hoadon->thang_nam ?? null)->first();

            if ($hoaDonHienTai) {
                $thangNamHienTai = $hoaDonHienTai->thang_nam;
                $thangNamTruoc = \Carbon\Carbon::parse($thangNamHienTai . '-01')->subMonth()->format('Y-m');
                $hoaDonThangTruoc = $hopdong->hoaDons->where('thang_nam', $thangNamTruoc)->first();

                $hoadon->chi_so_dien_cu = $hoaDonThangTruoc?->so_dien ?? 0;
                $hoadon->chi_so_nuoc_cu = $hoaDonThangTruoc?->so_nuoc ?? 0;
            } else {
                $hoadon->chi_so_dien_cu = 0;
                $hoadon->chi_so_nuoc_cu = 0;
            }

            // Tạo PDF
            $pdf = Pdf::loadView('admin.hoadon.pdf_hoadon', compact('hoadon'));

            return $pdf->download("hoa-don-{$hoadon->ma_hoa_don}.pdf");
        }

}
