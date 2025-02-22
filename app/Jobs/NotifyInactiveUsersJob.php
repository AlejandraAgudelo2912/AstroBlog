<?php

namespace App\Jobs;

use App\Mail\InactiveUserNotificationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyInactiveUsersJob
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function __construct()
    {
    }

    public function handle(): void
    {
        $inactiveUsers = User::where('last_login_at', '<', Carbon::now()->subDays(20))->get();

        foreach ($inactiveUsers as $user) {
            Mail::to($user->email)->send(new InactiveUserNotificationMail($user));
        }
    }
}
