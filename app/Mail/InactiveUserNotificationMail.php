<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InactiveUserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct() {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Te extrañamos en AstroBlog!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inactive-user-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
