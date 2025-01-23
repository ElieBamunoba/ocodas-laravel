<?php

namespace App\Providers;

use App\View\Components\AdminNavigation;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
    public function boot()
    {

        Blade::component('layouts.admin.guest', 'layouts.admin.guest');
        Blade::component('layouts.admin.app', 'layouts.admin.app');
        Blade::component('layouts.admin.navigation', 'layouts.admin.navigation');

        Blade::component('layouts.guest', 'layouts.guest');
        Blade::component('layouts.app', 'layouts.app');

        Blade::component('admin-navigation', AdminNavigation::class);

    }
}
