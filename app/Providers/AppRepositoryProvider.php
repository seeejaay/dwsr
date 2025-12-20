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

use App\Repository\TaxTypeRepository\TaxTypeRepository;
use App\Repository\TaxTypeRepository\TaxTypeRepositoryInterface;

use App\Repository\VarianceRepository\VarianceRepository;
use App\Repository\VarianceRepository\VarianceRepositoryInterface;

use App\Repository\AdjustmentCategoryRepository\AdjustmentCategoryRepository;
use App\Repository\AdjustmentCategoryRepository\AdjustmentCategoryRepositoryInterface;

use App\Repository\RoleRepository\RoleRepository;
use App\Repository\RoleRepository\RoleRepositoryInterface;

use App\Repository\SiteRepository\SiteRepository;
use App\Repository\SiteRepository\SiteRepositoryInterface;
class AppRepositoryProvider extends ServiceProvider
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
        $this->app->bind(TaxTypeRepositoryInterface::class, TaxTypeRepository::class);
        $this->app->bind(VarianceRepositoryInterface::class, VarianceRepository::class);
        $this->app->bind(AdjustmentCategoryRepositoryInterface::class, AdjustmentCategoryRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(SiteRepositoryInterface::class, SiteRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
