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
    Route::post('api/categories', [CategoryController::class, 'post']);

    //Products
    Route::get('api/products', [ProductsController::class, 'getAll']);
});

