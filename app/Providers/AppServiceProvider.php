<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Observers\UserObserver;
use App\Policies\PostPolicy;
use App\View\Components\BlogLayout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('blog-layout', BlogLayout::class);

        Gate::policy(Post::class, PostPolicy::class);

        Gate::define('manage-users', function ($user) {
            return $user->hasRole('god') || $user->hasRole('admin');
        });

        User::observe(UserObserver::class);
    }
}
