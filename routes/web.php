<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Rutas públicas (ecommerce)
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Perfil (usando controlador de Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panel de usuario personalizado
    Route::get('/mi-cuenta', fn() => view('user.dashboard'))->name('user.dashboard');
});

require __DIR__ . '/auth.php';
