<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\HopDong;
use App\Models\User;

class HopDongMoiMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $hopDong;


    /**
     * Create a new message instance.
     */
    public function __construct(User $user, HopDong $hopDong)
    {
        $this->user = $user;
        $this->hopDong = $hopDong;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông báo hợp đồng thuê văn phòng',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Thông báo hợp đồng thuê văn phòng')
            ->view('admin.emails.hopdongmoi')
            ->with([
                'user' => $this->user,
                'hopDong' => $this->hopDong,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

}