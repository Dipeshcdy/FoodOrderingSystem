<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendVendorEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $content,$subject,$deliveryInfo;
    /**
     * Create a new message instance.
     */
    public function __construct($content,$subject,$deliveryInfo)
    {
        $this->content=$content;
        $this->subject=$subject;
        $this->deliveryInfo=$deliveryInfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        try {
            return new Content(
                view: 'email.SendVendorEmail',
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }
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