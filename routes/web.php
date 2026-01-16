<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;

// Página principal: llama al ProductController@index
Route::get('/', [ProductController::class, 'index']);

// Rutas de productos
Route::resource('/products', ProductController::class);

// Rutas de comentarios (opcional)
// Route::resource('/comments', CommentController::class);
