<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\AuthRepository\AuthRepository;
use App\Repository\AuthRepository\AuthRepositoryInterface;
class AppInterfaceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
