<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// NOTE:understand Route names

// using route group
Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.', // all routes names will start with dashboard. 
    'prefix' => 'dashboard' // all routes  will start with dashboard 
], function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('/categories', CategoriesController::class);
});
