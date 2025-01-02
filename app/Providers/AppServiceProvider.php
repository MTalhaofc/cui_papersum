<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        
    if(env('FORCE_HTTPS',false)) { // Default value should be false for local server
        URL::forceScheme('https');
    }
    }
}
