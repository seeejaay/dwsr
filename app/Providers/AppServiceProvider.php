<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Services\AuthService\AuthService;
use App\Services\AuthService\AuthServiceInterface;

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
        //
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }
}
