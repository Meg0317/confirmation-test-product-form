<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
// 登録画面
Route::get('/products/register', [ProductController::class, 'create']);
Route::post('/products/register', [ProductController::class, 'store']);

//詳細画面
Route::get('/products/{productId}', [ProductController::class, 'show']);
Route::patch('/products/{productId}/update', [ProductController::class, 'update']);
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy']);
