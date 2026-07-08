<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAuthController;


Route::get('/', [CustomerController::class, 'home'])->name('home');
Route::get('/produk', [CustomerController::class, 'catalog'])->name('catalog');
Route::get('/produk/{product}', [CustomerController::class, 'show'])->name('product.show');
Route::post('/produk/{product}/pesan', [CustomerController::class, 'storeOrder'])->name('order.store');
Route::get('/pesanan/{order}/sukses', [CustomerController::class, 'orderSuccess'])->name('order.success');

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
