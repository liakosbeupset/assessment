<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/import-posts', [\App\Http\Controllers\ImportPostsController::class, 'import'])->name('api.posts.import');
