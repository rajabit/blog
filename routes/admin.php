<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Admin\IndexController::class, 'index'])->name('dashboard');

Route::resources([
     'posts' => App\Http\Controllers\Admin\PostController::class
]);
