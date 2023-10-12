<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\Api\Client\OrderController;
use App\Http\Controllers\Api\Client\ServiceController;
use App\Http\Controllers\Api\Client\ServiceProviderController;


Route::prefix('v1/client')->group(function(){

    Route::controller(AuthController::class)->group(function(){
        Route::post('register' , 'register');
        Route::post('login' , 'login');
    });

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('logout' , [AuthController::class , 'logout']);

        Route::controller(ServiceController::class)->group(function(){
            Route::get('services' , 'services');
            Route::get('service/{id}' , 'service');
        });
        Route::controller(ServiceProviderController::class)->group(function(){
            Route::get('servicesProviders' , 'servicesProviders');
            Route::get('serviceProvider/{id}' , 'serviceProvider');
        });
        Route::controller(OrderController::class)->group(function(){
            Route::get('order/{id}' , 'order');
            Route::post('order/{id}' , 'order_status');
        });
    });
});
