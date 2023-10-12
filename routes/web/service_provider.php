<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Service_Provider\AuthController;
use App\Http\Controllers\Web\Service_Provider\ProfileController;
use App\Http\Controllers\Web\Service_Provider\DashboardController;
use App\Http\Controllers\Web\Service_Provider\OrderController;

Route::prefix('provider')->group(function(){

    Route::get('/login', [AuthController::class , 'login'])->name('provider.login');
    Route::post('/login', [AuthController::class , 'recordLogin']);

    Route::middleware('provider')->group(function(){

        Route::get('dashboard' , [DashboardController::class , 'dashboard'])->name('provider.dashboard');
        Route::post('settings' , [ProfileController::class , 'settings']);
        Route::get('logout' , [AuthController::class , 'logout'])->name('provider.logout');

        Route::controller(OrderController::class)->group(function(){
            Route::get('orders' , 'index');
        });

    });
});
