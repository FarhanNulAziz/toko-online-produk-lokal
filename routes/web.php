<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;


Route::get('/', [CustomerController::class, 'home'])->name('home');
Route::get('/produk', [CustomerController::class, 'catalog'])->name('catalog');
Route::get('/produk/{product}', [CustomerController::class, 'show'])->name('product.show');

Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/sukses', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/riwayat-pesanan', [OrderHistoryController::class, 'index'])->name('orders.history');
});

Route::middleware('guest')->group(function () {
    Route::get('/masuk', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
    Route::post('/masuk', [CustomerAuthController::class, 'login'])->name('customer.login.store');
    Route::get('/daftar', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
    Route::post('/daftar', [CustomerAuthController::class, 'register'])->name('customer.register.store');
});
Route::post('/keluar', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    
    Route::resource('products', ProductController::class);

    Route::resource('orders', OrderController::class);

});


require __DIR__ . '/settings.php';
