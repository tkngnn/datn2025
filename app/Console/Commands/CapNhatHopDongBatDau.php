<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HopDong;
use App\Models\VanPhong;
use Carbon\Carbon;

class CapNhatHopDongBatDau extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hopdong:capnhat-batdau';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật trạng thái hợp đồng khi đến ngày bắt đầu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $hopDongs = HopDong::whereDate('ngay_bat_dau', $today)
            ->where('da_thanh_ly', false)
            ->get();

        $soCapNhatDangThue = 0;
        $soCapNhatHuy = 0;
        $soVanPhongDaThue = 0;


        foreach ($hopDongs as $hopDong) {
            $chiTiet = $hopDong->chiTietHopDongs->first();
            $vanPhong = optional($chiTiet)->vanPhong;

            if ($hopDong->tinh_trang === 'da ky') {
                $hopDong->tinh_trang = 'dang thue';
                $hopDong->save();

                if ($vanPhong) {
                    $vanPhong->trang_thai = 'da thue';
                    $vanPhong->save();
                }

                $soVanPhongDaThue++;
                $soCapNhatDangThue++;
            } else {
                $hopDong->tinh_trang = 'đã hủy';
                $hopDong->save();

                $soCapNhatHuy++;
            }
        }

        $this->info("✔ Cập nhật {$soCapNhatDangThue} hợp đồng sang 'đang thuê', {$soCapNhatHuy} hợp đồng sang 'đã hủy', {$soVanPhongDaThue} văn phòng sang đã thuê.");
    }
}