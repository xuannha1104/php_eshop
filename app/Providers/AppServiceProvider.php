<?php

namespace App\Providers;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetails\OrderDetailsRepository;
use App\Repositories\OrderDetails\OrderDetailsRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategoryRepository\ProductCategoryRepository;
use App\Repositories\ProductCategoryRepository\ProductCategoryRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Blog\BlogService;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Brand\BrandService;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Cart\CartService;
use App\Services\Cart\CartServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetails\OrderDetailsService;
use App\Services\OrderDetails\OrderDetailsServiceInterface;
use App\Services\PaypalPayment\PaypalPaymentService;
use App\Services\PaypalPayment\PaypalPaymentServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategoryService\ProductCategoryService;
use App\Services\ProductCategoryService\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentService;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Ultities\Validation\BaseForm;
use App\Ultities\Validation\LoginForm;
use App\Ultities\Validation\OrderForm;
use App\Ultities\Validation\RegisterFrom;
use App\Ultities\Validation\UserCreateFrom;
use App\Ultities\Validation\UserEditFormNoPassword;
use App\Ultities\Validation\UserEditFrom;
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

        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );

        // Product Comment
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );

        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );

        // Blog
        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );

        // Product Category
        $this->app->singleton(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );

        $this->app->singleton(
            ProductCategoryServiceInterface::class,
            ProductCategoryService::class
        );

        // Brand
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );

        // Order
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );

        // Order Details
        $this->app->singleton(
            OrderDetailsRepositoryInterface::class,
            OrderDetailsRepository::class
        );

        $this->app->singleton(
            OrderDetailsServiceInterface::class,
            OrderDetailsService::class
        );

        // Cart Service
        $this->app->singleton(
            CartServiceInterface::class,
            CartService::class
        );

        // Paypal payment service
        $this->app->singleton(
            PaypalPaymentServiceInterface::class,
            PaypalPaymentService::class
        );

        // Login Validation
        $this->app->singleton(
            BaseForm::class,LoginForm::class
        );

        // Register Validation
        $this->app->singleton(
            BaseForm::class,RegisterFrom::class
        );
        // Order Form Validation
        $this->app->singleton(
            BaseForm::class,OrderForm::class
        );

        // User Form Validation
        $this->app->singleton(
            BaseForm::class,UserCreateFrom::class
        );
        $this->app->singleton(
            BaseForm::class,UserEditFrom::class
        );
        $this->app->singleton(
            BaseForm::class,UserEditFormNoPassword::class
        );

        // User
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
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
