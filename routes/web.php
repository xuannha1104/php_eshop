<?php

use App\Http\Middleware\CheckMemberLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front (Client) Route
Route::get('/',[\App\Http\Controllers\Front\HomeController::class,'index']) ;

Route::prefix('shop')->group(function (){
    Route::get('',[\App\Http\Controllers\Front\ShopController::class,'index']);
    Route::get('products/{id}',[\App\Http\Controllers\Front\ShopController::class,'show']);
    Route::post('products/{id}',[\App\Http\Controllers\Front\ShopController::class,'postComment']);
    Route::get('category/{categoryName}',[\App\Http\Controllers\Front\ShopController::class,'category']);
});

Route::prefix('cart')->group(function (){
    Route::get('/',[\App\Http\Controllers\Front\CartController::class,'index']);
    Route::get('add',[\App\Http\Controllers\Front\CartController::class,'add']);
    Route::get('delete',[\App\Http\Controllers\Front\CartController::class,'delete']);
    Route::get('destroy',[\App\Http\Controllers\Front\CartController::class,'destroy']);
    Route::get('update',[\App\Http\Controllers\Front\CartController::class,'update']);
});

Route::prefix('check-out')->group(function (){
    Route::get('',[\App\Http\Controllers\Front\CheckOutController::class,'index']);
    Route::post('',[\App\Http\Controllers\Front\CheckOutController::class,'addOrder']);
    Route::get('result',[\App\Http\Controllers\Front\CheckOutController::class,'orderResult']);
    Route::get('success',[\App\Http\Controllers\Front\CheckOutController::class,'successTransaction'])->name('successPayment');
    Route::get('cancel',[\App\Http\Controllers\Front\CheckOutController::class,'cancelTransaction'])->name('cancelPayment');
});

Route::prefix('account')->group(function (){
    Route::get('register',[\App\Http\Controllers\Front\AccountController::class,'register'])->name('register');
    Route::post('register',[\App\Http\Controllers\Front\AccountController::class,'checkRegister'])->name('checkRegister');
    Route::get('login',[\App\Http\Controllers\Front\AccountController::class,'login'])->name('login');
    Route::post('login',[\App\Http\Controllers\Front\AccountController::class,'checkLogin'])->name('checkLogin');
    Route::get('logout',[\App\Http\Controllers\Front\AccountController::class,'logout'])->name('logout');
});

Route::group(['prefix'=>'my-order','middleware' => 'CheckMemberLogin'],function (){
    Route::get('',[\App\Http\Controllers\Front\AccountController::class,'myOrder'])->name('myOrderIndex');
    Route::get('{orderId}',[\App\Http\Controllers\Front\AccountController::class,'orderDetails'])->name('orderDetails');
});

// Dashboard (Admin) Route
Route::prefix('admin')->group(function (){
    Route::prefix('user')->middleware('CheckAdminLogin')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('UserManager');
        Route::get('{id}',[\App\Http\Controllers\Admin\UserController::class,'show']);
        Route::delete('id}',[\App\Http\Controllers\Admin\UserController::class,'destroy']);
        Route::get('edit/{id}',[\App\Http\Controllers\Admin\UserController::class,'edit']);
        Route::put('edit/{id}',[\App\Http\Controllers\Admin\UserController::class,'update']);
    });
    Route::get('user-create',[\App\Http\Controllers\Admin\UserController::class,'create'])->middleware('CheckAdminLogin');
    Route::post('user-create',[\App\Http\Controllers\Admin\UserController::class,'store'])->middleware('CheckAdminLogin');

    Route::prefix('login')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\HomeController::class,'getLogin']);
        Route::post('',[\App\Http\Controllers\Admin\HomeController::class,'login'])->name('adminLogin');
    });
    Route::get('logout',[\App\Http\Controllers\Admin\HomeController::class,'logout']);

    Route::prefix('brand')->middleware('CheckAdminLogin')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\BrandController::class,'index'])->name('BrandManager');
        Route::get('create',[\App\Http\Controllers\Admin\BrandController::class,'create'])->name('BrandCreate');
        Route::post('create',[\App\Http\Controllers\Admin\BrandController::class,'store']);
        Route::get('edit/{id}',[\App\Http\Controllers\Admin\BrandController::class,'edit'])->name('BrandEdit');
        Route::put('edit/{id}',[\App\Http\Controllers\Admin\BrandController::class,'update']);
        Route::delete('delete/{id}',[\App\Http\Controllers\Admin\BrandController::class,'destroy'])->name('BrandDelete');
    });

    Route::prefix('category')->middleware('CheckAdminLogin')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\ProductCategoryController::class,'index'])->name('CategoryManager');
        Route::get('create',[\App\Http\Controllers\Admin\ProductCategoryController::class,'create'])->name('CategoryCreate');
        Route::post('create',[\App\Http\Controllers\Admin\ProductCategoryController::class,'store']);
        Route::get('edit/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'edit'])->name('CategoryEdit');
        Route::put('edit/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'update']);
        Route::delete('delete/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'destroy'])->name('CategoryDelete');
    });

    Route::prefix('product')->middleware('CheckAdminLogin')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\ProductController::class,'index'])->name('ProductManager');
        Route::get('create',[\App\Http\Controllers\Admin\ProductController::class,'create'])->name('ProductCreate');
        Route::post('create',[\App\Http\Controllers\Admin\ProductController::class,'store'])->name('ProductStore');
        Route::get('detail/{id}',[\App\Http\Controllers\Admin\ProductController::class,'show'])->name('ProductDetails');
        Route::get('edit/{id}',[\App\Http\Controllers\Admin\ProductController::class,'edit'])->name('ProductEdit');
        Route::put('edit/{id}',[\App\Http\Controllers\Admin\ProductController::class,'update']);
        Route::delete('delete/{id}',[\App\Http\Controllers\Admin\ProductController::class,'destroy'])->name('ProductDelete');

        Route::get('detail-info/{productId}',[\App\Http\Controllers\Admin\ProductController::class,'showDetails'])->name('ProductDetailsManager');
        Route::get('detail-info-create/{productId}',[\App\Http\Controllers\Admin\ProductController::class,'createDetails'])->name('ProductDetailsCreate');
        Route::post('detail-info-create/{productId}',[\App\Http\Controllers\Admin\ProductController::class,'storeDetails'])->name('ProductDetailsStore');
        Route::get('detail-info-edit/{id}',[\App\Http\Controllers\Admin\ProductController::class,'editDetails'])->name('ProductDetailsEdit');
        Route::put('detail-info-edit/{id}',[\App\Http\Controllers\Admin\ProductController::class,'updateDetails'])->name('ProductDetailsUpdate');;
        Route::delete('detail-info-delete/{id}',[\App\Http\Controllers\Admin\ProductController::class,'destroyDetails'])->name('ProductDetailsDelete');

        Route::get('images/{productId}',[\App\Http\Controllers\Admin\ProductController::class,'imagesIndex'])->name('ProductImagesManager');
        Route::put('images/{productId}',[\App\Http\Controllers\Admin\ProductController::class,'imagesStore'])->name('ProductImagesStore');
        Route::get('images-list',[\App\Http\Controllers\Admin\ProductController::class,'imageList']);
        Route::post('images-upload',[\App\Http\Controllers\Admin\ProductController::class,'imageUpload']);
        Route::delete('images-delete',[\App\Http\Controllers\Admin\ProductController::class,'imageDelete']);

    });

    Route::prefix('order')->middleware('CheckAdminLogin')->group(function ()
    {
        Route::get('',[\App\Http\Controllers\Admin\OrderController::class,'index'])->name('OrderManager');
        Route::get('/{id}',[\App\Http\Controllers\Admin\OrderController::class,'show'])->name('OrderDetails');
    });
});
