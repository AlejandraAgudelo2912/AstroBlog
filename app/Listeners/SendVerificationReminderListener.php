<?php

namespace App\Listeners;

use App\Events\UserUnverifiedFor24HoursEvent;
use App\Mail\VerificationReminderMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationReminderListener
{
    use InteractsWithQueue;
    public function __construct()
    {
    }

    public function handle(UserUnverifiedFor24HoursEvent $event): void
    {
        if (!$event->user->hasVerifiedEmail()) {
            Mail::to($event->user->email)->send(new VerificationReminderMail($event->user));
        }
    }
}
