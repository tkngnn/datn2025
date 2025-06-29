<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HoaDonSendMailer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

use App\Models\HopDong;
use App\Models\VanPhong;
use App\Models\ChiTietHopDong;
use App\Models\ToaNha;
use App\Models\User;
use App\Models\HoaDon;

class ChiSoController extends Controller
{
    public function index(Request $request)
    {
        $query = HoaDon::with(['hopdong.chiTietHopDongs.vanphong.toanha', 'hopdong.user','hopdong.hoaDons']);
        if ($request->filled('ma_toa_nha')) {
            $query->whereHas('hopdong.chiTietHopDongs.vanphong.toanha', function ($q) use ($request) {
                $q->where('ma_toa_nha', $request->ma_toa_nha);
            });
        }

        if ($request->filled('thang_nam')) {
            $query->where('thang_nam', $request->thang_nam);
        }

        if ($request->filled('trang_thai') && $request->trang_thai == 'da nhap') {
                $query->whereNotNull('so_dien')->whereNotNull('so_nuoc');
        }

        if ($request->filled('trang_thai') && $request->trang_thai == 'chua nhap') {
                $query->whereNull('so_dien')->whereNull('so_nuoc');
        }

        $hoadons = $query->get();
        $chuaNhap=0;

        foreach ($hoadons as $hoadon) {
            if(!$hoadon->so_dien || !$hoadon->so_nuoc){
                $chuaNhap = $chuaNhap + 1;
            }
            $hopdong = $hoadon->hopdong;
            $hoaDonHienTai = $hopdong->hoaDons->where('thang_nam', $hoadon->thang_nam ?? null)->first();

            if ($hoaDonHienTai) {
                $thangNamHienTai = $hoaDonHienTai->thang_nam;                
                $thangNamTruoc = Carbon::parse($thangNamHienTai . '-01')->subMonth()->format('Y-m');

                $hoaDonThangTruoc = $hopdong->hoaDons->where('thang_nam', $thangNamTruoc)->first();
                if ($hoaDonThangTruoc) {

                    $hoadon->chi_so_dien_cu = $hoaDonThangTruoc?->so_dien ?? 0;
                    $hoadon->chi_so_nuoc_cu = $hoaDonThangTruoc?->so_nuoc ?? 0;
                } else {
                    $hoadon->chi_so_dien_cu = 0;
                    $hoadon->chi_so_nuoc_cu = 0;
                }
            }
        }
        $dsToaNha=ToaNha::all();

        return view('admin.chiso.index', compact('hoadons','chuaNhap','dsToaNha'));
    }

    public function create(Request $request)
    {
        $toanhas = ToaNha::all();
        $query = HoaDon::whereNull('so_dien')
        ->whereNull('so_nuoc')
        ->with([
            'hopdong.user',
            'hopdong.chiTietHopDongs.vanphong.toanha'
        ]);
        if ($request->filled('ma_toa_nha')) {
            $query->whereHas('hopdong.chiTietHopDongs.vanphong.toanha', function ($q) use ($request) {
                $q->where('ma_toa_nha', $request->ma_toa_nha);
            });
        }
        if ($request->filled('thang_nam')) {
            $query->where('thang_nam', $request->thang_nam);
        }
        $hoadons = $query->get();

        foreach($hoadons as $hoadon){
            $thangNamCuaHoaDon = $hoadon->thang_nam;
            $thangNamTruoc = Carbon::parse($thangNamCuaHoaDon . '-01')->subMonth()->format('Y-m');
            $hoaDonTruoc = HoaDon::where('ma_hop_dong', $hoadon->ma_hop_dong)
            ->where('thang_nam', $thangNamTruoc)
            ->first();

            $hoadon->chi_so_dien_cu = $hoaDonTruoc?->so_dien ?? 0;
            $hoadon->chi_so_nuoc_cu = $hoaDonTruoc?->so_nuoc ?? 0;
        }
        

        return view('admin.chiso.create', compact('hoadons','toanhas')); 
    }

    public function store(Request $request)
    {
        $dsSoDien = $request->input('so_dien', []);
        $dsSoNuoc = $request->input('so_nuoc', []);
        $chiSoLoi = [];
        $chiSoThanhCong = 0;
        $today = Carbon::create(2025, 6, 10);
        $thangNay=$today->copy()->format('Y-m');
        $thangTruoc=$today->copy()->subMonth()->format('Y-m');
        $cuoiThang = $today->copy()->endOfMonth();

        foreach ($dsSoDien as $maHoaDon => $soDien) {
            $soNuoc = $dsSoNuoc[$maHoaDon] ?? null;

            if ($soDien === null || $soDien === '' || $soNuoc === null || $soNuoc === '') {
                continue;
            }

            $hoaDon = HoaDon::with('hopdong.chiTietHopDongs.vanphong')->find($maHoaDon);
            if (!$hoaDon || !$hoaDon->hopdong) continue;

            $thangNamCuaHoaDon = $hoaDon->thang_nam;
            $thangNamTruoc = Carbon::parse($thangNamCuaHoaDon . '-01')->subMonth()->format('Y-m');
            $hoaDonTruoc = HoaDon::where('ma_hop_dong', $hoaDon->ma_hop_dong)
            ->where('thang_nam', $thangNamTruoc)->first();

            $soDienCu = $hoaDonTruoc?->so_dien ?? 0;
            $soNuocCu = $hoaDonTruoc?->so_nuoc ?? 0;

            if ($soDien <= $soDienCu || $soNuoc <= $soNuocCu) {
                $chiSoLoi[] = "Hóa đơn #$maHoaDon có chỉ số không hợp lệ (Điện cũ: $soDienCu >= $soDien, Nước cũ: $soNuocCu >= $soNuoc)";
                continue;
            }   

            $soDien = ceil($soDien);
            $soNuoc = ceil($soNuoc);

            $chiTiet = $hoaDon->hopdong->chiTietHopDongs->first();
            if (!$chiTiet) continue;

            $donGiaDien = $chiTiet->gia_dien ;
            $donGiaNuoc = $chiTiet->gia_nuoc ;
            $tienThue = $hoaDon->tien_thue ;

            $dienTieuThu = $soDien - $soDienCu;
            $nuocTieuThu = $soNuoc - $soNuocCu;

            $tienDien = $dienTieuThu * $donGiaDien;
            $tienNuoc = $nuocTieuThu * $donGiaNuoc;
            $tienDichVuKhac= $chiTiet->dich_vu_khac ?? 0;
            $tongThanhToan = ($tienDien + $tienNuoc + $tienThue + $tienDichVuKhac) * 1.1;

            $hoaDon->update([
                'so_dien' => $soDien,
                'so_nuoc' => $soNuoc,
                'tien_dien'=>$tienDien,
                'tien_nuoc'=>$tienNuoc,
                'tong_tien' => $tongThanhToan,
            ]);
            $chiSoThanhCong++;

            if(
                ($today->day > 5 && $thangNamCuaHoaDon <= $thangTruoc) ||
                ($today->day < $cuoiThang && $thangNamCuaHoaDon === $thangNay ) 
            ){
                Log::info("Truyền vào Mailer HĐ #$maHoaDon | điện cũ: $soDienCu | nước cũ: $soNuocCu");
                Mail::to($hoaDon->hopdong->user->email)->send(new HoaDonSendMailer($hoaDon, $soDienCu, $soNuocCu));
            }
            
        }
        return redirect()->route('admin.chiso.create')->with([
            'success' => "Đã thêm thành công {$chiSoThanhCong} chỉ số.",
            'warning' => implode('<br>', $chiSoLoi)
            
        ]);
    }

}