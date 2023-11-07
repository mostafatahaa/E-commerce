<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
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

Route::resource('cart', CartController::class);

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products', [ProductsController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
    ->name('products.show');

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);

Route::get('auth/user/2fa', [TwoFactorAuthController::class, 'index'])
    ->name('front.2fa');






// require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
