<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;


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
    public function boot()
{
    // Trust all proxies (required for Heroku)
    Request::setTrustedProxies(
        ['*'], // Trust all proxies
        Request::HEADER_X_FORWARDED_ALL // Trust X-Forwarded headers
    );

    // Force HTTPS if the request is not secure
    if ($this->isHttpRequest()) {
        URL::forceScheme('https');
    }
}

/**
 * Check if the current request is HTTP (and not HTTPS).
 *
 * @return bool
 */
protected function isHttpRequest()
{
    return request()->header('X-Forwarded-Proto') !== 'https';
}
}
