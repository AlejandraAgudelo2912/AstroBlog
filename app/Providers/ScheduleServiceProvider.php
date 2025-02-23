<?php

namespace App\Providers;

use App\Jobs\NotifyInactiveUsersJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            $schedule->command('logs:clear')->daily();
            $schedule->command('backup:database')->daily()->at('02:00');
            $schedule->command('all:clear')->daily();
            $schedule->command('verification:send')->daily();

            $schedule->call(function () {
                NotifyInactiveUsersJob::dispatchSync();
            })->daily();
        });
    }
}
