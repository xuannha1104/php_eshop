<?php

namespace App\Providers;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Services\Blog\BlogService;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductComment\ProductCommentService;
use App\Services\ProductComment\ProductCommentServiceInterface;
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
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        //Product Service
        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );

        // Product Comment
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );

        //Product Comment Service
        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );

        // Product Comment
        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        //Product Comment Service
        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
