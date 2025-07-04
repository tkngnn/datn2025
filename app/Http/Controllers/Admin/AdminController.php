<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToaNha;
use App\Models\HopDong;
use App\Models\VanPhong;
use App\Models\HoaDon;
use App\Models\User;
use App\Models\KhachHang;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $totalToaNha = ToaNha::count();
        $totalPhong = VanPhong::count();
        $totalPhongDangThue = VanPhong::where('trang_thai', 'da thue')->count();
        $totalPhongConTrong = VanPhong::where('trang_thai', 'dang trong')->count();

        $totalKhachThue = User::where('vai_tro', 'KT')->count();
        $userActive = User::where('vai_tro', 'KT')->where('trang_thai', true)->count();

        $totalHopDong = HopDong::count();
        $hopDongHieuLuc = HopDong::where('tinh_trang', 'dang thue')->count();
        $hopDongDaThanhLy = HopDong::where('tinh_trang', 'da thanh ly')->count();
        $hopDongMoi = HopDong::where('created_at', '>=', now()->subDays(7))->count();

        $totalHoaDon = HoaDon::count();
        $hoaDonChuaTT = HoaDon::where('trang_thai', 'chua thanh toan')->count();
        $hoaDonDaTT = HoaDon::where('trang_thai', 'da thanh toan')->count();
        $hoaDonMoi = HoaDon::where('created_at', '>=', now()->subDays(7))->count();

        $year = date('Y');
        $month = date('m');
        $toaNha = $request->input('toa_nha', '');

        $query = DB::table('hop_dong as hd')
            ->select(
                DB::raw("DATE_FORMAT(hd.ngay_bat_dau, '%Y-%m') as thang"),
                DB::raw('SUM(hd.tong_tien_coc) as tien_coc'),
                DB::raw('SUM(tt.so_tien) as tien_thu'),
                DB::raw('SUM(ct.dich_vu_khac) as dich_vu_phu')
            )
            ->leftJoin('chi_tiet_hop_dong as ct', 'hd.ma_hop_dong', '=', 'ct.ma_hop_dong')
            ->leftJoin('van_phong as vp', 'ct.ma_van_phong', '=', 'vp.ma_van_phong')
            ->leftJoin('toa_nha as tn', 'vp.ma_toa_nha', '=', 'tn.ma_toa_nha')
            ->leftJoin('hoa_don as hdon', 'hd.ma_hop_dong', '=', 'hdon.ma_hop_dong')
            ->leftJoin('thanh_toan as tt', 'tt.ma_hoa_don', '=', 'hdon.ma_hoa_don')
            ->whereYear('hd.ngay_bat_dau', $year)
            ->whereMonth('hd.ngay_bat_dau', $month);

        if (!empty($toaNha)) {
            $query->where('tn.ma_toa_nha', $toaNha);
        }

        $data = $query
            ->groupBy('thang')
            ->first();

        $doanhThuHienTai = (object)[
            'thang' => "$year-$month",
            'tien_coc' => $data->tien_coc ?? 0,
            'tien_thu' => $data->tien_thu ?? 0,
            'dich_vu_phu' => $data->dich_vu_phu ?? 0,
        ];

        $khachhangs = KhachHang::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.index', compact(
            'totalToaNha',
            'totalPhong',
            'totalPhongDangThue',
            'totalPhongConTrong',
            'totalKhachThue',
            'userActive',
            'totalHopDong',
            'hopDongHieuLuc',
            'hopDongDaThanhLy',
            'hopDongMoi',
            'totalHoaDon',
            'hoaDonChuaTT',
            'hoaDonDaTT',
            'hoaDonMoi',
            'doanhThuHienTai',
            'year',
            'month',
            'toaNha',
            'khachhangs'
        ));
    }

}