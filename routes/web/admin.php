<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\AuthController;
use App\Http\Controllers\Web\Admin\ClientController;
use App\Http\Controllers\Web\Admin\ProfileController;
use App\Http\Controllers\Web\Admin\ServiceController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\ServiceProviderController;


Route::prefix('admin')->group(function(){

    Route::get('/login', [AuthController::class , 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class , 'recordLogin']);

    Route::middleware('admin')->group(function(){

        Route::get('dashboard' , [DashboardController::class , 'dashboard'])->name('admin.dashboard');
        Route::post('settings' , [ProfileController::class , 'settings']);
        Route::get('logout' , [AuthController::class , 'logout'])->name('admin.logout');

        Route::controller(ServiceController::class)->group(function(){
            Route::get('services' , 'index');
            Route::post('service/create' , 'create');
            Route::post('service/edit/{id}' , 'edit');
            Route::post('service/delete/{id}' , 'delete');
        });
        Route::controller(ServiceProviderController::class)->group(function(){
            Route::get('services_providers' , 'index');
            Route::post('service_provider/create' , 'create');
            Route::post('service_provider/delete/{id}' , 'delete');
        });

        Route::controller(ClientController::class)->group(function(){
            Route::get('clients' , 'index');
            Route::post('client/changeStatus' , 'changeStatus');
            Route::post('client/delete/{id}' , 'delete');
        });

    });

});
