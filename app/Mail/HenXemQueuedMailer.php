<?php

namespace App\Mail;

use App\Models\HenXem;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class HenXemQueuedMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $henxem;

    public function __construct($henxem)
    {
        $this->henxem = $henxem;
    }

    public function build()
    {
        return $this->subject('Đã hủy lịch hẹn xem văn phòng')
                    ->view('admin.emails.henxem_dahuy')
                    ->with([
                        'henxem' => $this->henxem,
                    ]);
    }
}