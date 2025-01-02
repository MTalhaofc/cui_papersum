<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
     *  * @return void

     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        if (app()->environment('remote') || env('FORCE_HTTPS',false)) {
            URL::forceScheme('https');
        }
    }
}
