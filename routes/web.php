<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

// Route Awal masuk website
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Route untuk halaman dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// Route untuk produk
Route::resource('products', ProductController::class);
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


// Route untuk pesanan
Route::resource('orders', OrderController::class);
Route::get('orders/user/{userId}', [OrderController::class, 'userOrders'])->name('orders.userOrders');
Route::post('orders/{orderId}/add-item', [OrderController::class, 'addItem'])->name('orders.addItem');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// Route untuk dasboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');