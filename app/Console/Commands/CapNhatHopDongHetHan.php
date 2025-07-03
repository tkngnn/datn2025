<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HopDong;
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
        $soLuong = HopDong::where('da_thanh_ly', false)
            ->where('ngay_ket_thuc', '<', Carbon::now())
            ->where('tinh_trang', '!=', 'het han')
            ->update(['tinh_trang' => 'het han']);

        $this->info("Đã cập nhật {$soLuong} hợp đồng hết hạn.");
    }
}