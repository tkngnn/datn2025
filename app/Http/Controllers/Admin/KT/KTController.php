<?php

namespace App\Http\Controllers\Admin\KT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\HopDong;
use App\Models\HoaDon;
use App\Models\YeuCauHoTro;
use App\Models\User;
use App\Models\ToaNha;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class KTController extends Controller
{
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


    public function DSHopDong(Request $request)
    {
        $user = Auth::user();

        $query = HopDong::where('user_id', $user->id);

        if ($request->filled('ma_toa_nha')) {
            $query->whereHas('chiTietHopDongs.vanphong.toanha', function ($q) use ($request) {
                $q->where('ma_toa_nha', $request->ma_toa_nha);
            });
        }

        if ($request->filled('trang_thai')) {
            $query->where('tinh_trang', $request->trang_thai);
        }

        $hopDongs = $query->get();
        $dsToaNha = ToaNha::all();

        return view('admin.kt.dshopdong', compact('hopDongs', 'dsToaNha'));
    }


    public function preview_hopdong($id)
    {
        $hopdong = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])
            ->where('ma_hop_dong', $id)
            ->firstOrFail();
        $chiTiet = $hopdong->chiTietHopDongs->first();
        $vanPhong = $chiTiet->vanPhong;
        $toaNha = $vanPhong->toaNha;

        return view('admin.kt.preview_hopdong', compact('hopdong', 'chiTiet', 'vanPhong', 'toaNha'));
    }

    public function exportPDF_hopdong($id)
    {
        $hopdong = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])
            ->where('ma_hop_dong', $id)
            ->firstOrFail();
        $chiTiet = $hopdong->chiTietHopDongs->first();
        $vanPhong = $chiTiet->vanPhong;
        $toaNha = $vanPhong->toaNha;

        $pdf = Pdf::loadView('admin.kt.preview_hopdong', [
            'hopdong'=>$hopdong,
            'chiTiet'=>$chiTiet,
            'vanPhong'=>$vanPhong,
            'toaNha'=>$toaNha,
            'is_pdf' => true])
            ->setOptions(['defaultFont' => 'DejaVu Sans']);
        return $pdf->download("hop-dong-{$hopdong->ma_hop_dong}.pdf");
    }


    public function DSHoaDon(Request $request)
    {
        $user = Auth::user();

        $query = HoaDon::whereHas('hopDong', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereNotNull("so_dien")
            ->whereNotNull("so_nuoc");
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
            /*->orderByRaw("CASE WHEN trang_thai = 'chua thanh toan' THEN 0 ELSE 1 END") 
            ->orderByDesc('thang_nam')*/
            $hoaDons=$query->get();

            $dsToaNha=ToaNha::all();

        return view('admin.kt.dshoadon', compact('hoaDons','dsToaNha'));
    }

    public function preview_hoadon($id)
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

    public function exportPDF_hoadon($id)
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

        $pdf = Pdf::loadView('admin.kt.pdf_hoadon', compact('hoadon'));
        return $pdf->download("hoa-don-{$hoadon->ma_hoa_don}.pdf");
    }


    public function DSHoTro(Request $request)
    {
        $user = Auth::user();
        $query = YeuCauHoTro::where('user_id', $user->id);
        if ($request->filled('trang_thai')) {
                $query->where('trang_thai_xu_ly', $request->trang_thai);
            }
        $hoTros=$query->get();

        return view('admin.kt.dshotro', compact('hoTros'));
    }

    public function hotro_create()
    {
        $user = Auth::user();
        $hoTros = YeuCauHoTro::where('user_id', $user->id)->get();
        
        return view('admin.kt.hotro_create', compact('hoTros'));
    }
    public function hotro_store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
        ]);

        $data['user_id'] = $user->id;
        $data['thoi_gian_gui'] = now();
        $data['trang_thai_xu_ly'] = 'chua xu ly';
        $data['ghi_chu_xu_ly'] = null;

        YeuCauHoTro::create($data);

        return response()->json(['message' => 'Gửi yêu cầu hỗ trợ thành công.']);
    }
}