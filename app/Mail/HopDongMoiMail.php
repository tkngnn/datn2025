<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HopDongMoiMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $hopDong;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $hopDong)
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
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.hopdongmoi', // Make sure this path is correct
            with: [
                'user' => $this->user,
                'hopDong' => $this->hopDong,
            ],
        );
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