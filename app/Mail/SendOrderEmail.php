<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendOrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$cart,$subject;
    /**
     * Create a new message instance.
     */
    public function __construct($name,$cart,$subject)
    {
        $this->name=$name;
        $this->cart=$cart;
        $this->subject=$subject;
        
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
            view: 'email.SendOrderEmail',
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