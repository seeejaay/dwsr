<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Services\AuthService\AuthService;
use App\Services\AuthService\AuthServiceInterface;

use App\Services\UserService\UserService;
use App\Services\UserService\UserServiceInterface;

use App\Services\PumpService\PumpService;
use App\Services\PumpService\PumpServiceInterface;

use App\Services\TankService\TankService;
use App\Services\TankService\TankServiceInterface;

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
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PumpServiceInterface::class, PumpService::class);
        $this->app->bind(TankServiceInterface::class, TankService::class);
    }
}
