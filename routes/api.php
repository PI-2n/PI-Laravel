<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Public routes
Route::get('auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']); // Note: In API, this usually redirects to frontend

Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('home', [ProductController::class, 'home'])->name('api.home'); // New endpoint
Route::get('products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::get('/tags', [App\Http\Controllers\Api\TagController::class, 'index']); // Public so frontend can fetch them
Route::get('/platforms', [App\Http\Controllers\Api\PlatformController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Protected CRUD routes
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);

    // Cart Sync
    Route::post('cart/sync', [App\Http\Controllers\Api\CartController::class, 'sync']);

    // Orders
    Route::get('orders/{id}', [App\Http\Controllers\Api\OrderController::class, 'show']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Checkout
    Route::get('/checkout', [App\Http\Controllers\Api\CheckoutController::class, 'index']);
    Route::post('/checkout', [App\Http\Controllers\Api\CheckoutController::class, 'processPayment']);

    // Profile
    Route::get('/profile/library', [App\Http\Controllers\Api\ProfileController::class, 'library']);
    Route::patch('/profile', [App\Http\Controllers\Api\ProfileController::class, 'update']);
    Route::put('/password', [App\Http\Controllers\Api\ProfileController::class, 'updatePassword']);
    Route::delete('/profile', [App\Http\Controllers\Api\ProfileController::class, 'destroy']);

    // Admin routes
    Route::post('/products/import', [App\Http\Controllers\ProductImportController::class, 'import']);

    // Comments
    Route::post('products/{product}/comments', [App\Http\Controllers\Api\CommentController::class, 'store']);
    Route::put('comments/{comment}', [App\Http\Controllers\Api\CommentController::class, 'update']);
    Route::delete('comments/{comment}', [App\Http\Controllers\Api\CommentController::class, 'destroy']);
});