<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts.all');
})->name('posts.all');
