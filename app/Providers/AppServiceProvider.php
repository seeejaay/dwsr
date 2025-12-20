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

use App\Services\TaxTypeService\TaxTypeService;
use App\Services\TaxTypeService\TaxTypeServiceInterface;

use App\Services\VarianceService\VarianceService;
use App\Services\VarianceService\VarianceServiceInterface;

use App\Services\AdjustmentCategoryService\AdjustmentCategoryService;
use App\Services\AdjustmentCategoryService\AdjustmentCategoryServiceInterface;

use App\Services\RoleService\RoleService;
use App\Services\RoleService\RoleServiceInterface;

use App\Services\SiteService\SiteService;
use App\Services\SiteService\SiteServiceInterface;

use App\Services\ProductService\ProductService;
use App\Services\ProductService\ProductServiceInterface;

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
        $this->app->bind(TaxTypeServiceInterface::class, TaxTypeService::class);
        $this->app->bind(VarianceServiceInterface::class, VarianceService::class);
        $this->app->bind(AdjustmentCategoryServiceInterface::class, AdjustmentCategoryService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(SiteServiceInterface::class, SiteService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }
}
