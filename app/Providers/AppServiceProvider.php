<?php

namespace App\Providers;

use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Permission\PermissionService;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleService;
use App\Services\Role\RoleServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            // register category
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        // register brand
        $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
        //need cmt
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        //Review
        $this->app->singleton(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->singleton(ReviewRepositoryInterface::class, ReviewRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Schema::defaultStringLength(191);
    }
}
