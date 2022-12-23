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
    Route::get('product/{id}',[\App\Http\Controllers\Front\ShopController::class,'show']);
    Route::post('product/{id}',[\App\Http\Controllers\Front\ShopController::class,'postComment']);
});


