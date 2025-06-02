<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/posts', [\App\Http\Controllers\PostsController::class, 'all'])->name('posts.all');
