<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recordatorio: Verifica tu correo electrónico',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verification-reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
