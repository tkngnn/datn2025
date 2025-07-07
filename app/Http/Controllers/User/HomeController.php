<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VanPhong;
use App\Models\ToaNha;
use App\Models\ChiTietHopDong;
use App\Models\HopDong;
//use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsPhuongHCM = [
            'Phường Bến Thành',
            'Phường Cô Giang',
            'Phường Nguyễn Cư Trinh',
            'Phường 6',
            'Phường Võ Thị Sáu',
            'Phường 14',
            'Phường 25',
        ];

        $thongKeHCM = [];

        foreach ($dsPhuongHCM as $phuong) {
            $count = ToaNha::where('dia_chi', 'like', '%' . $phuong . '%')->whereRaw('LOWER(trang_thai) = ?', ['hoat dong'])->count();
            $tenFile = Str::slug($phuong) . '.jpg';
            $thongKeHCM[] = [
                'phuong' => $phuong,
                'so_toa_nha' => $count,
                'hinh_anh' => asset('user/assets/img/index/TPHCM/' . $tenFile),
            ];
        }

        $tongToaNha = ToaNha::count();

        $tongVanPhong = VanPhong::count();

        $vanPhongDaChoThue = ChiTietHopDong::distinct('ma_van_phong')->count('ma_van_phong');

        $soKhachHang = HopDong::distinct('user_id')->count('user_id');

        return view('user.home.index', compact(
            'thongKeHCM',
            'tongToaNha',
            'tongVanPhong',
            'vanPhongDaChoThue',
            'soKhachHang'
        ));
    }



    public function danhsach(Request $request)
    {
        try {
            $query = VanPhong::with(['toaNha', 'media'])
                ->whereRaw("LOWER(TRIM(trang_thai)) = ?", ['dang trong']);

            $dsToaNha = ToaNha::select('ma_toa_nha', 'ten_toa_nha')
                ->where('trang_thai', 'hoat dong')
                ->get();

            if ($request->filled('ten_toa_nha')) {
                $query->whereHas('toaNha', function ($q) use ($request) {
                    $q->where(function ($subQuery) use ($request) {
                        $subQuery->where('ten_toa_nha', 'like', '%' . $request->ten_toa_nha . '%')
                            ->orWhere('dia_chi', 'like', '%' . $request->ten_toa_nha . '%');
                    });
                });
            }

            if ($request->filled('dien_tich')) {
                switch ($request->dien_tich) {
                    case '50-100':
                        $query->whereBetween('dien_tich', [50, 100]);
                        break;
                    case '100-200':
                        $query->whereBetween('dien_tich', [100, 200]);
                        break;
                    case '200-300':
                        $query->whereBetween('dien_tich', [200, 300]);
                        break;
                    case '300-500':
                        $query->whereBetween('dien_tich', [300, 500]);
                        break;
                    case '500-1000':
                        $query->whereBetween('dien_tich', [500, 1000]);
                        break;
                    case '1000+':
                        $query->where('dien_tich', '>', 1000);
                        break;
                }
            }

            if ($request->filled('gia_thue')) {
                switch ($request->gia_thue) {
                    case '1000-2000':
                        $query->whereBetween('gia_thue', [1000, 2000]);
                        break;
                    case '2000-3000':
                        $query->whereBetween('gia_thue', [2000, 3000]);
                        break;
                    case '3000-5000':
                        $query->whereBetween('gia_thue', [3000, 5000]);
                        break;
                    case '5000-7000':
                        $query->whereBetween('gia_thue', [5000, 7000]);
                        break;
                    case '7000-10000':
                        $query->whereBetween('gia_thue', [7000, 10000]);
                        break;
                    case '10000+':
                        $query->where('gia_thue', '>', 10000);
                        break;
                }
            }

            if ($request->filled('toa_nha_id')) {
                $query->where('ma_toa_nha', $request->toa_nha_id);
            }

            if ($request->filled('sap_xep')) {
                if ($request->sap_xep == 'asc') {
                    $query->orderBy('gia_thue', 'asc');
                } elseif ($request->sap_xep == 'desc') {
                    $query->orderBy('gia_thue', 'desc');
                }
            }

            $danhSachVanPhong = $query->paginate(8);

            if ($request->ajax()) {
                return response()->json([
                    'html' => view('user.home.danhsach_table', compact('danhSachVanPhong'))->render(),
                    'pagination' => view('user.home.danhsach_phantrang', [
                        'paginator' => $danhSachVanPhong,
                    ])->render(),
                ]);
            }

            Log::info('Danh sách văn phòng được lấy thành công', [
                'count' => $danhSachVanPhong->count(),
                'timestamp' => now(),
            ]);
            return view('user.home.danhsach', compact('danhSachVanPhong', 'dsToaNha'));
        } catch (Exception $e) {
            Log::error('Lỗi khi truy vấn danh sách văn phòng: ' . $e->getMessage());

            return view('user.home.danhsach', [
                'danhSachVanPhong' => collect(), 
                'dsToaNha' => collect(),        
                'error' => 'Không thể truy xuất dữ liệu, vui lòng thử lại sau.'
            ]);
        }
    }


    public function about()
    {
        $tongToaNha = ToaNha::count();

        $tongVanPhong = VanPhong::count();

        $vanPhongDaChoThue = ChiTietHopDong::distinct('ma_van_phong')->count('ma_van_phong');

        $soKhachHang = HopDong::distinct('user_id')->count('user_id');

        return view('user.home.about', compact(
            'tongToaNha',
            'tongVanPhong',
            'vanPhongDaChoThue',
            'soKhachHang'
        ));
    }
}