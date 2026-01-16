<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('index');
});

Route::resource('/products', ProductController::class);
// Route::resource('/comments', CommentController::class);