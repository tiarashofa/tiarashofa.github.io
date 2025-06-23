<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->middleware(['auth'])->name('products.index');

Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->middleware(['auth'])->name('products.create');

Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->middleware(['auth'])->name('products.show');

Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->middleware(['auth'])->name('products.edit');

Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware(['auth'])->name('products.destroy');

Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->middleware(['auth'])->name('orders.index');

Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->middleware(['auth'])->name('orders.create');

Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->middleware(['auth'])->name('customers.index');

Route::get('/customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->middleware(['auth'])->name('customers.create');

Route::get('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'show'])->middleware(['auth'])->name('customers.show');

Route::get('/customers/{customer}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->middleware(['auth'])->name('customers.edit');

Route::delete('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'destroy'])->middleware(['auth'])->name('customers.destroy');

require __DIR__.'/auth.php';
