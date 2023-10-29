<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\View\Components\FrontLayout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products', [ProductsController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
    ->name('products.show');





require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
