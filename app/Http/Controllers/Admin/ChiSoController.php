<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HopDong;
use App\Models\VanPhong;
use App\Models\ChiTietHopDong;
use App\Models\ToaNha;
use App\Models\User;
use App\Models\HoaDon;

class ChiSoController extends Controller
{
    public function index()
    {
        $hoadons = HoaDon::with(['hopdong.chiTietHopDongs.vanphong.toanha', 'hopdong.user'])->get();

        foreach ($hoadons as $hoadon) {
            $hopdong = $hoadon->hopdong;
            $hoaDonHienTai = $hopdong->hoaDons->where('thang_nam', $hoadon->thang_nam ?? null)->first();

            if ($hoaDonHienTai) {
                $thangNamHienTai = $hoaDonHienTai->thang_nam;
                $hoaDonThangTruoc = $hopdong->hoaDonThangTruoc($thangNamHienTai);

                $hoadon->chi_so_dien_cu = $hoaDonThangTruoc?->so_dien ?? 0;
                $hoadon->chi_so_nuoc_cu = $hoaDonThangTruoc?->so_nuoc ?? 0;
            } else {
                $hoadon->chi_so_dien_cu = 0;
                $hoadon->chi_so_nuoc_cu = 0;
            }
        }

        return view('admin.chiso.index', compact('hoadons'));
    }

    public function create()
    {
        $toanhas = ToaNha::all();
        $hoadons = HoaDon::whereNull('so_dien')
        ->whereNull('so_nuoc')
        ->with([
            'hopdong.user',
            'hopdong.chiTietHopDongs.vanphong.toanha'
        ])
        ->get();

        return view('admin.chiso.create', compact('hoadons','toanhas')); 
    }

    public function store(Request $request)
    {
//  dd($request->all());
        $dsSoDien = $request->input('so_dien', []);
        $dsSoNuoc = $request->input('so_nuoc', []);

        foreach ($dsSoDien as $maHoaDon => $soDien) {
            $soDien = floatval($soDien);
            $soNuoc = floatval($dsSoNuoc[$maHoaDon]) ?? null;

            if ($soDien === null || $soDien === '' || $soNuoc === null || $soNuoc === '') {
                continue;
            }

            $hoaDon = HoaDon::with('hopdong.chiTietHopDongs.vanphong')->find($maHoaDon);
            if (!$hoaDon || !$hoaDon->hopdong) continue;

            $chiTiet = $hoaDon->hopdong->chiTietHopDongs->first();
            if (!$chiTiet) continue;

            $donGiaDien = $chiTiet->gia_dien ?? 0;
            $donGiaNuoc = $chiTiet->gia_nuoc ?? 0;
            $giaThue = $chiTiet->vanphong->gia_thue ?? 0;

            $tienDien = $soDien * $donGiaDien;
            $tienNuoc = $soNuoc * $donGiaNuoc;
            $tongThanhToan = $tienDien + $tienNuoc + $giaThue;

            $hoaDon->update([
                'so_dien' => $soDien,
                'so_nuoc' => $soNuoc,
                'tong_tien' => $tongThanhToan,
            ]);
        }
        return redirect()->route('admin.chiso.create')->with('success', 'Thêm văn phòng thành công');
    }

}
