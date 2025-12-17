<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\AuthRepository\AuthRepository;
use App\Repository\AuthRepository\AuthRepositoryInterface;

use App\Repository\UserRepository\UserRepository;
use App\Repository\UserRepository\UserRepositoryInterface;

use App\Repository\PumpRepository\PumpRepository;
use App\Repository\PumpRepository\PumpRepositoryInterface;

use App\Repository\TankRepository\TankRepository;
use App\Repository\TankRepository\TankRepositoryInterface;

class AppInterfaceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PumpRepositoryInterface::class, PumpRepository::class);
        $this->app->bind(TankRepositoryInterface::class, TankRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
