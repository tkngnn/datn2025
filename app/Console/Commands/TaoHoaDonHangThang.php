<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\HoaDonHangThang;
use Carbon\Carbon;

class TaoHoaDonHangThang extends Command
{
    protected $signature = 'hoadon:tao-hang-thang';
    protected $description = 'Tạo hóa đơn vào ngày 30 hằng tháng hoặc ngày cuối tháng 2';

    public function handle()
    {
        $today = Carbon::now();
        //$today = Carbon::create(2025, 6, 30);

        if (
            $today->day === 30 ||
            ($today->month === 2 && $today->isLastOfMonth())
        ) {
            HoaDonHangThang::dispatch();
            $this->info('Đã dispatch Job tạo hóa đơn');
        } else {
            $this->info('Không phải ngày tạo hóa đơn');
        }
    }
}
