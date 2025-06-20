<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HoaDonSendMailer;

use App\Models\HoaDon;

class HoaDonController extends Controller
{
    public function index()
    {
        $hoadons = HoaDon::with(['hopdong.chiTietHopDongs.vanphong.toanha', 'hopdong.user'])->get();
        foreach($hoadons as $hoadon){
            if($hoadon->trang_thai==="chua thanh toan"){
                $hanDong = \Carbon\Carbon::parse($hoadon->thang_nam . '-01')->addMonth()->day(10);

                $soNgayQuaHan = now()->greaterThan($hanDong) ? (int) $hanDong->diffInDays(now()) : 0;

                $hoadon->so_ngay_qua_han = $soNgayQuaHan;
            }
        }
        
        return view('admin.hoadon.index', compact('hoadons'));
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
}
