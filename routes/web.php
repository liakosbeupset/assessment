<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/posts', function () {
    return view('posts.all');
})->name('posts.all');
