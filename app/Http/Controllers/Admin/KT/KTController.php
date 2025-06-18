<?php

namespace App\Http\Controllers\Admin\KT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\HopDong;
use App\Models\HoaDon;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class KTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        Log::info('User accessed KT index', ['user_id' => $user->id, 'user_name' => $user->name]);
        $hoaDonChuaThanhToan = HoaDon::whereHas('hopDong', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereNotNull("so_dien")
            ->whereNotNull("so_nuoc")
            ->where('trang_thai', 'chua thanh toan')
            ->count();
        return view('admin.kt.index', compact('user','hoaDonChuaThanhToan'));
    }

    public function DSHopDong()
    {
        $user = Auth::user();
        $hopDongs = HopDong::where('user_id', $user->id)->get();

        return view('admin.kt.dshopdong', compact('hopDongs'));
    }
    public function DSHoaDon()
    {
        $user = Auth::user();

        $hoaDons = HoaDon::whereHas('hopDong', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereNotNull("so_dien")
            ->whereNotNull("so_nuoc")
            /*->orderByRaw("CASE WHEN trang_thai = 'chua thanh toan' THEN 0 ELSE 1 END") 
            ->orderByDesc('thang_nam')*/
            ->get();

        return view('admin.kt.dshoadon', compact('hoaDons'));
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
        
        return view('admin.kt.preview_hoadon', compact('hoadon'));
    }

    public function exportPDF($id)
    {
        $hoadon = HoaDon::with(['hopdong.chiTietHopDongs.vanphong.toanha', 'hopdong.user','hopdong.hoaDons'])->findOrFail($id);

        // Tính chỉ số cũ
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

        $pdf = Pdf::loadView('admin.kt.preview_hoadon', [
            'hoadon'=>$hoadon,
            'is_pdf' => true])
            ->setOptions(['defaultFont' => 'DejaVu Sans']);
        return $pdf->download("hoa-don-{$hoadon->ma_hoa_don}.pdf");
    }
    
}