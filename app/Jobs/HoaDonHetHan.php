<?php

namespace App\Jobs;

use App\Models\HopDong;
use App\Models\HoaDon;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class HoaDonHetHan implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $today = Carbon::now();
        $thangNam = $today->format('Y-m');
        $dauThang = $today->copy()->startOfMonth();
        $cuoiThang = $today->copy()->endOfMonth();
        if ($cuoiThang->day == 31) {
            $cuoiThang = $cuoiThang->subDay();
        }

        $hopDongs = HopDong::with('chiTietHopDongs')
                    ->where('tinh_trang', 'dang thue')
                    ->orderBy('ma_hop_dong')
                    ->get();

        foreach ($hopDongs as $hopdong) {
            $ngayBatDau = Carbon::parse($hopdong->ngay_bat_dau);
            $ngayKetThuc = Carbon::parse($hopdong->ngay_ket_thuc);
            $giaThue = $hopdong->chiTietHopDongs->first()->gia_thue;

            $canTaoHoaDon = false;
            $ngayThue = 30;
            $soNgayConLai = (int) $today->diffInDays($ngayKetThuc,false);
            Log::info("HĐ {$hopdong->ma_hop_dong} - Ngày còn lại: {$soNgayConLai}");

            if (
                $ngayKetThuc->between($dauThang, $cuoiThang) &&
                $soNgayConLai >= 0 && $soNgayConLai <= 3
            ) {
                $canTaoHoaDon = true;
                $ngayThue = floor($dauThang->diffInDays($ngayKetThuc) + 1);
            }

            if ($canTaoHoaDon) {
                $tienThue = floor(($giaThue / 30) * $ngayThue);
                Log::info("Tiền thuê: {$tienThue}");
                $hoaDon = HoaDon::firstOrCreate(
                    ['ma_hop_dong' => $hopdong->ma_hop_dong, 'thang_nam' => $thangNam],
                    [
                        'so_dien' => null,
                        'so_nuoc' => null,
                        'tong_tien' => 0,
                        'trang_thai' => 'chua thanh toan',
                        'tien_thue' => $tienThue
                    ]
                );
            }
        }
    }
}