<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;


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
        // $settings = Setting::checkSettings();
        // View()->share([
        //     'settings'=>$settings,
        // ]);
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        // Paginator::defaultView('vendor.pagination.custom_dashboard');
    }
}
