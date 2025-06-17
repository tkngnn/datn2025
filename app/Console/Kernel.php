<?php

namespace App\Console;

use App\Jobs\TaoHoaDonHangThang;
use App\Jobs\TaoHoaDonHetHan;
use App\Jobs\GuiHoaDonHangThang;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
            \App\Console\Commands\TaoHoaDonHangThang::class,
            \App\Console\Commands\TaoHoaDonHetHan::class,
            \App\Console\Commands\GuiHoaDonHangThang::class,
        ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('hoadon:tao-hang-thang')->monthlyOn(30, '08:00');
        $schedule->command('hoadon:het-han')->dailyAt('08:00');
        $schedule->command('gui:hoa-don-hang-thang')->monthlyOn(5, '08:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
