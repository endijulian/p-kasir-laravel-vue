<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\StockInProductController;
use App\Http\Controllers\Api\StockOutProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');

});

Route::apiResource('/users', UserController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/barangMasuk', StockInProductController::class);
Route::apiResource('/barangKeluar', StockOutProductController::class);



Route::get('roles', [RolesController::class, 'index'])->name('roles');

Route::get('addToCart/{id}', [CartController::class, 'AddToCart'])->name('AddToCart');
Route::get('cart/product', [CartController::class, 'CartProduct'])->name('CartProduct');


Route::get('increment/{id}', [CartController::class, 'increment'])->name('increment');
Route::get('decrement/{id}', [CartController::class, 'decrement'])->name('decrement');
