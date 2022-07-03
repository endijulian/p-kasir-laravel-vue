<?php

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
