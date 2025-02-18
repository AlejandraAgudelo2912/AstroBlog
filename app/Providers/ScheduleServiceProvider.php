<?php

namespace App\Providers;

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
        });
    }
}
