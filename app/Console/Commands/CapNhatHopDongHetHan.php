<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HopDong;
use App\Models\VanPhong;
use Carbon\Carbon;

class CapNhatHopDongHetHan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hopdong:capnhat-hethan';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động cập nhật trạng thái hết hạn cho hợp đồng';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hopDongs = HopDong::where('da_thanh_ly', false)
            ->where('ngay_ket_thuc', '<', Carbon::now())
            ->where('tinh_trang', '!=', 'het han')
            ->get();

        $soLuong = 0;
        $vanPhongIds = [];

        foreach ($hopDongs as $hopDong) {
            $hopDong->tinh_trang = 'het han';
            $hopDong->save();

            $vanPhongIds[] = optional($hopDong->chiTietHopDongs->first())->ma_van_phong;
            $soLuong++;
        }

        $vanPhongIds = array_filter(array_unique($vanPhongIds));

        VanPhong::whereIn('ma_van_phong', $vanPhongIds)->update([
            'trang_thai' => 'dang trong'
        ]);

        $this->info("Đã cập nhật {$soLuong} hợp đồng hết hạn và văn phòng tương ứng về trạng thái đang trống.");
    }
}