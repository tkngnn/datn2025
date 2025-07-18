<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToaNha;
use App\Models\HopDong;
use App\Models\ChiTietHopDong;
use App\Models\VanPhong;
use App\Models\HoaDon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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

        //cho phần thời gian thuê
        $dsToaNhaCB = ToaNha::all();
        $year = (int) $request->input('year', date('Y'));
        $maToaNha = $request->input('toa_nha', '');

        return view('admin.thongke.index', compact(
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
            'dsToaNhaCB',
            'maToaNha',
            'year'
        ));
    }

    public function doanhThuThang(Request $request)
    {
        $year = $request->input('nam', date('Y'));

        $toaNha = $request->input('toa_nha', '');

        $dsToaNha = DB::table('toa_nha')->get();

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
            ->whereYear('hd.ngay_bat_dau', $year);

        if (!empty($toaNha)) {
            $query->where('tn.ma_toa_nha', $toaNha);
        }

        $reportData = $query->groupBy('thang')
            ->orderBy('thang', 'desc')
            ->get()
            ->keyBy('thang');

        $allMonths = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = sprintf('%04d-%02d', $year, $i);
            $allMonths[$month] = (object)[
                'thang' => $month,
                'tien_coc' => 0,
                'tien_thu' => 0,
                'dich_vu_phu' => 0,
            ];
        }

        foreach ($reportData as $month => $data) {
            $allMonths[$month] = $data;
        }

        ksort($allMonths);

        $report = collect(array_values($allMonths));

        return view('admin.thongke.doanhthu', compact('report', 'year', 'dsToaNha', 'toaNha'));
    }

    public function tyLeLapDay(Request $request)
    {
        $thangYear = $request->input('thang_year', date('m/Y'));

        if (preg_match('/^(\d{1,2})\/(\d{4})$/', $thangYear, $matches)) {
            $month = (int)$matches[1];
            $year = (int)$matches[2];
        } else {
            $month = date('m');
            $year = date('Y');
        }

        Log::info("Tháng: $month, Năm: $year");

        $maToaNha = $request->input('toa_nha', '');

        $dsToaNha = $maToaNha
            ? ToaNha::where('ma_toa_nha', $maToaNha)->get()
            : ToaNha::all();
        $dsToaNhaCB = ToaNha::all();

        $result = [];

        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        Log::info("Start of Month: " . $startOfMonth->toDateString() . ", End of Month: " . $endOfMonth->toDateString());

        foreach ($dsToaNha as $toaNha) {
            $dienTichTong = VanPhong::where('ma_toa_nha', $toaNha->ma_toa_nha)->sum('dien_tich');

            $dienTichThue = ChiTietHopDong::join('hop_dong', 'chi_tiet_hop_dong.ma_hop_dong', '=', 'hop_dong.ma_hop_dong')
                ->join('van_phong', 'chi_tiet_hop_dong.ma_van_phong', '=', 'van_phong.ma_van_phong')
                ->where('van_phong.ma_toa_nha', $toaNha->ma_toa_nha)
                ->where('hop_dong.tinh_trang', 'dang thue')
                ->whereDate('hop_dong.ngay_bat_dau', '<=', $endOfMonth)
                ->where(function ($query) use ($startOfMonth) {
                    $query->whereNull('hop_dong.ngay_ket_thuc')
                        ->orWhereDate('hop_dong.ngay_ket_thuc', '>=', $startOfMonth);
                })
                ->groupBy('chi_tiet_hop_dong.ma_van_phong')
                ->selectRaw('MAX(chi_tiet_hop_dong.dien_tich) as dien_tich')
                ->pluck('dien_tich')
                ->sum();

            Log::info("Toà nhà: $toaNha->ten_toa_nha - Tổng: $dienTichTong m² - Đang thuê: $dienTichThue m²");


            $tyLe = $dienTichTong > 0 ? ($dienTichThue / $dienTichTong) * 100 : 0;

            $result[] = [
                'toa_nha' => $toaNha->ten_toa_nha,
                'ty_le_lap_day' => round($tyLe, 2),
            ];
        }

        return view('admin.thongke.tylelapday', compact('result', 'month', 'year', 'dsToaNha', 'maToaNha', 'dsToaNhaCB'));
    }

    /*public function thoiGianThueVanPhong(Request $request)
    {
        $year = (int) $request->input('year', date('Y'));
        $maToaNha = $request->input('toa_nha', '');

        $dsToaNha = $maToaNha
            ? ToaNha::where('ma_toa_nha', $maToaNha)->get()
            : ToaNha::all();
        $dsToaNhaCB = ToaNha::all();

        $data = [];

        foreach ($dsToaNha as $toaNha) {
            $vanPhongs = VanPhong::where('ma_toa_nha', $toaNha->ma_toa_nha)->get();

            foreach ($vanPhongs as $vp) {
                $thoiGianThue = array_fill(1, 12, 'trong');

                $dsHopDong = ChiTietHopDong::join('hop_dong', 'chi_tiet_hop_dong.ma_hop_dong', '=', 'hop_dong.ma_hop_dong')
                    ->where('ma_van_phong', $vp->ma_van_phong)
                    ->whereYear('hop_dong.ngay_bat_dau', '<=', $year)
                    ->where(function ($query) use ($year) {
                        $query->whereNull('hop_dong.ngay_ket_thuc')
                            ->orWhereYear('hop_dong.ngay_ket_thuc', '>=', $year);
                    })
                    ->select('hop_dong.ngay_bat_dau', 'hop_dong.ngay_ket_thuc')
                    ->get();

                foreach ($dsHopDong as $hd) {
                    $start = Carbon::parse($hd->ngay_bat_dau)->year == $year ? Carbon::parse($hd->ngay_bat_dau)->month : 1;
                    $end = $hd->ngay_ket_thuc
                        ? (Carbon::parse($hd->ngay_ket_thuc)->year == $year ? Carbon::parse($hd->ngay_ket_thuc)->month : 12)
                        : 12;

                    for ($m = $start; $m <= $end; $m++) {
                        $thoiGianThue[$m] = 'thue';
                    }
                }

                $data[] = [
                    'ten_van_phong' => 'VP #' . $vp->ma_van_phong,
                    'thoi_gian' => $thoiGianThue,
                ];
            }
        }

        return view('admin.thongke.thoigianthue', compact('data', 'year', 'dsToaNha', 'maToaNha', 'dsToaNhaCB'));
    }*/

    public function thoiGianThueVanPhong(Request $request)
    {
        $year = (int) $request->input('year', date('Y'));
        $maToaNha = $request->input('toa_nha', '');

        $dsToaNha = $maToaNha
            ? ToaNha::where('ma_toa_nha', $maToaNha)->get()
            : ToaNha::all();

        $data = [];

        foreach ($dsToaNha as $toaNha) {
            foreach ($toaNha->vanPhongs as $vp) {
                $thoiGianThue = array_fill(1, 12, 'trong');

                $dsHopDong = ChiTietHopDong::join('hop_dong', 'chi_tiet_hop_dong.ma_hop_dong', '=', 'hop_dong.ma_hop_dong')
                    ->leftJoin('hop_dong_thanh_ly', 'hop_dong.ma_hop_dong', '=', 'hop_dong_thanh_ly.ma_hop_dong')
                    ->where('ma_van_phong', $vp->ma_van_phong)
                    ->whereYear('hop_dong.ngay_bat_dau', '<=', $year)
                    ->where(function ($query) use ($year) {
                        $query->whereNull('hop_dong.ngay_ket_thuc')
                            ->orWhereYear('hop_dong.ngay_ket_thuc', '>=', $year);
                    })
                    ->selectRaw('hop_dong.ngay_bat_dau, COALESCE(hop_dong_thanh_ly.ngay_chuyen_di, hop_dong.ngay_ket_thuc)  AS ket_thuc_thuc_te')
                    ->get();

                foreach ($dsHopDong as $hd) {
                    $start = Carbon::parse($hd->ngay_bat_dau)->year == $year ? Carbon::parse($hd->ngay_bat_dau)->month : 1;
                    $end = $hd->ket_thuc_thuc_te
                        ? (Carbon::parse($hd->ket_thuc_thuc_te)->year == $year
                            ? Carbon::parse($hd->ket_thuc_thuc_te)->month
                            : 12)
                        : 12;

                    for ($m = $start; $m <= $end; $m++) {
                        $thoiGianThue[$m] = 'thue';
                    }
                }

                $data[] = [
                    'ten_van_phong' => $toaNha->ten_toa_nha . ' - ' . ($vp->ten_van_phong ?? ('VP #' . $vp->ma_van_phong)),
                    'thoi_gian' => $thoiGianThue,
                ];
            }
        }
        Log::info($data);
        return response()->json($data);
    }
}
