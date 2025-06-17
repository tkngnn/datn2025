<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VanPhong;
use App\Models\ToaNha;
//use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.layouts.app');
    }

    public function danhsach(Request $request)
    {
        $query = VanPhong::with(['toaNha', 'media'])
            ->whereRaw("LOWER(TRIM(trang_thai)) = ?", ['dang trong']);

        if ($request->filled('ten_toa_nha')) {
            $query->whereHas('toaNha', function ($q) use ($request) {
                $q->where('ten_toa_nha', 'like', '%' . $request->ten_toa_nha . '%');
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

        // Filter theo giá thuê
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

        // Sắp xếp
        if ($request->filled('sap_xep')) {
            if ($request->sap_xep == 'asc') {
                $query->orderBy('gia_thue', 'asc');
            } elseif ($request->sap_xep == 'desc') {
                $query->orderBy('gia_thue', 'desc');
            }
        }

        $danhSachVanPhong = $query->paginate(12);

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
        return view('user.home.danhsach', compact('danhSachVanPhong'));
    }
}