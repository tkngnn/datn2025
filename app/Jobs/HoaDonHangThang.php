<?php

namespace App\Jobs;

use App\Models\HopDong;
use App\Models\HoaDon;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class HoaDonHangThang implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $today = Carbon::now();
        //$today = Carbon::create(2025, 6, 30);
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

            if (
                ($today->day === 30 || ($today->month === 2 && $today->isLastOfMonth())) &&
                ($ngayKetThuc->gt($cuoiThang))
            ) {
                $canTaoHoaDon = true;
                if ($ngayBatDau->between($dauThang, $cuoiThang)) {
                    $ngayThue = floor($ngayBatDau->diffInDays($cuoiThang) + 1);
                } else {
                    $ngayThue = 30;
                }
            }

            \Log::info("Hóa đơn số: {$hopdong->ma_hoa_don}");
            \Log::info("Ngày thuê: {$ngayThue}");

            if ($canTaoHoaDon) {
                $tienThue = floor(($giaThue / 30) * $ngayThue);
                \Log::info("Tiền thuê: {$tienThue}");
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
