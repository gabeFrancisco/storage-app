<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('api/categories', [CategoryController::class, 'getAll']);
Route::get('api/products', [ProductsController::class, 'getAll']);
Route::post('api/auth/register', [AuthController::class, 'register']);
Route::post('api/categories', [CategoryController::class,'post'])->name('post');

