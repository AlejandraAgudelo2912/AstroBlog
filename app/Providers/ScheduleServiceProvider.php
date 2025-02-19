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
            $schedule->command('posts:feature-most-liked')->daily();
            $schedule->job(new NotifyInactiveUsersJob())->daily();
            $schedule->command('backup:database')->daily()->at('02:00');

        });
    }
}
