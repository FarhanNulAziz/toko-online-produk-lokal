<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;


Route::get('/', [CustomerController::class, 'home'])->name('home');
Route::get('/produk', [CustomerController::class, 'catalog'])->name('catalog');
Route::get('/produk/{product}', [CustomerController::class, 'show'])->name('product.show');
Route::post('/produk/{product}/pesan', [CustomerController::class, 'storeOrder'])->name('order.store');
Route::get('/pesanan/{order}/sukses', [CustomerController::class, 'orderSuccess'])->name('order.success');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    
    Route::resource('products', ProductController::class);

    Route::resource('orders', OrderController::class);

});


require __DIR__ . '/settings.php';
