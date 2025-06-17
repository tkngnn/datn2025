<?php

namespace App\Console\Commands;

use App\Models\HoaDon;
use Illuminate\Console\Command;
use App\Mail\HoaDonQueuedMailer;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class GuiHoaDonHangThang extends Command
{
    protected $signature = 'gui:hoa-don-hang-thang';
    protected $description = 'Gửi hóa đơn đã đầy đủ thông tin vào ngày 5 hằng tháng';

    public function handle()
    {
        $today=now();
        //$today = now()->setDate(2025, 6, 5);
        $thangHienTai=$today->copy()->format('Y-m');
        $thangHoaDonGui=$today->copy()->subMonth()->format('Y-m');

        $hoaDonsThangNay = HoaDon::with([
            'hopdong.user',
            'hopdong.chiTietHopDongs.vanPhong.toaNha'
        ])->where('thang_nam', $thangHoaDonGui)->get();
        

        foreach($hoaDonsThangNay as $hoadon){
            if($today->day==5 && $hoadon->so_dien !== null && $hoadon->so_nuoc !== null){

                $thangTruoc = Carbon::parse($thangHoaDonGui . '-01')->subMonth()->format('Y-m');

                $hoaDonTruoc = HoaDon::where('ma_hop_dong', $hoadon->ma_hop_dong)
                    ->where('thang_nam', $thangTruoc)
                    ->first();

                $soDienCu = $hoaDonTruoc?->so_dien ?? 0;
                $soNuocCu = $hoaDonTruoc?->so_nuoc ?? 0;

                Mail::to($hoadon->hopdong->user->email)->queue(new HoaDonQueuedMailer($hoadon,$soDienCu,$soNuocCu));
                \Log::info("Gửi cho {$hoadon->hopdong->user->email} với điện cũ {$soDienCu}, nước cũ {$soNuocCu}");
            }
        }
    }
}
