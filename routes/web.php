<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
| Página principal (equivale a tu antiguo index.php)
*/

Route::get('/', [ProductController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| PRODUCTOS
|--------------------------------------------------------------------------
| Solo las rutas que realmente usas
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| COMENTARIOS
|--------------------------------------------------------------------------
| Se mantiene preparada para el formulario
*/
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
