<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VanPhong;
use App\Models\ToaNha;
use Illuminate\Support\Facades\Log;

class TNVPController extends Controller
{

    public function getByToaNha($toaNhaId)
    {
        $vanPhongs = VanPhong::where('ma_toa_nha', $toaNhaId)
            ->whereIn('trang_thai', ['dang trong', 'dang xem'])
            ->get();

        Log::info('Lấy danh sách văn phòng cho tòa nhà: ' . $toaNhaId, ['vanPhongs' => $vanPhongs]);
        return response()->json($vanPhongs);
    }

    public function getDetails($vanPhongId)
    {
        $vanPhong = VanPhong::where('ma_van_phong', $vanPhongId)
            ->whereIn('trang_thai', ['dang trong', 'dang xem'])
            ->first();

        Log::info('Lấy chi tiết văn phòng: ' . $vanPhongId, ['vanPhong' => $vanPhong]);
        return response()->json([
            'ma_van_phong' => $vanPhong->ma_van_phong,
            'dien_tich' => $vanPhong->dien_tich,
            'gia_thue' => $vanPhong->gia_thue,
            'gia_dien' => $vanPhong->gia_dien ?? 3500,
            'gia_nuoc' => $vanPhong->gia_nuoc ?? 18000,
            'dich_vu_khac' => $vanPhong->dich_vu_khac ?? 'Không có',
        ]);
    }
}
