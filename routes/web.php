<?php

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


