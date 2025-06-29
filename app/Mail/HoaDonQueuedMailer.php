<?php

namespace App\Mail;

use App\Models\HoaDon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class HoaDonQueuedMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $hoadon;
    public $soDienCu;
    public $soNuocCu;

    public function __construct(HoaDon $hoadon, $soDienCu, $soNuocCu)
    { 
        $this->hoadon = $hoadon;
        $this->soDienCu = $soDienCu;
        $this->soNuocCu = $soNuocCu;
    }

    public function build()
    {
        Log::info("Điện cũ: " . $this->soDienCu);
        Log::info("Nước cũ: " . $this->soNuocCu);
        return $this->subject("Hóa đơn tháng {$this->hoadon->thang_nam}")
                    ->view('admin.emails.hoadon')
                    ->with([
                        'hoadon' => $this->hoadon,
                        'soDienCu' => $this->soDienCu,
                        'soNuocCu' => $this->soNuocCu,
                    ]);
    }
}