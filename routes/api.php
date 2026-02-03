<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Rutas CRUD completas para productos (solo para usuarios autenticados)
    Route::apiResource('products', ProductController::class)
        ->names('api.products')
        ->except(['show']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Ruta pública explícita para index (sin usar apiResource)
Route::get('products', [ProductController::class, 'index'])->name('api.products.index');