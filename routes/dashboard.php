<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('dashboard/categories', CategoriesController::class);
