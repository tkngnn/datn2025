<?php

namespace App\Console\Commands;

use App\Models\HopDong;
use App\Jobs\HoaDonHetHan;
use Illuminate\Console\Command;
use Carbon\Carbon;

class TaoHoaDonHetHan extends Command
{
    protected $signature = 'hoadon:het-han';
    protected $description = 'Tạo hóa đơn trước 3 ngày khi hết hạn hợp đồng';

    public function handle()
    {
        $today = Carbon::now();
        //$today = Carbon::create(2025, 6, 13);

        $hopDongs = HopDong::whereDate('ngay_ket_thuc', '>=', $today)
            ->whereDate('ngay_ket_thuc', '<=', $today->addDays(3))
            ->get();

        if ($hopDongs->isNotEmpty()) {
            HoaDonHetHan::dispatch();
            $this->info('Đã tạo hóa đơn cho hợp đồng sắp hết hạn.');
        } else {
            $this->info('Không có hợp đồng sắp hết hạn.');
        }
    }
}
