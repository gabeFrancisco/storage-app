<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//********************************* API endpoints ********************************

//Auth
Route::post('api/auth/register', [AuthController::class, 'register']);
Route::post('api/auth/login', [AuthController::class,'login']);


Route::middleware([JwtMiddleware::class])->group(function () {

    //Categories
    Route::get('api/categories', [CategoryController::class, 'getAll']);
    Route::get('api/categories/{id}', [CategoryController::class,'get']);
    Route::post('api/categories', [CategoryController::class, 'post']);
    Route::put('api/categories/{id}', [CategoryController::class,'update']);
    Route::delete('api/categories/{id}', [CategoryController::class,'delete']);

    //Products
    Route::get('api/products', [ProductsController::class, 'getAll']);
    Route::get('api/products/{id}', [ProductsController::class,'get']);
    Route::post('api/products', [ProductsController::class,'post']);
    Route::put('/api/products/{id}', [ProductsController::class,'update']);
});

