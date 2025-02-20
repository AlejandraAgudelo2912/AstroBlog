<?php

namespace App\Console\Commands;

use App\Events\UserUnverifiedFor24HoursEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendVerificationRemindersCommand extends Command
{
    protected $signature = 'verification:send';

    protected $description = 'Enviar un recordatorio a los usuarios que no han verificado su email en 24 horas.';

    public function handle(): void
    {
        $users = User::whereNull('email_verified_at')
            ->where('created_at', '<=', Carbon::now()->subDay())
            ->get();

        foreach ($users as $user) {
            event(new UserUnverifiedFor24HoursEvent($user));
        }

        $this->info('Recordatorios de verificación enviados correctamente.');
    }
}
