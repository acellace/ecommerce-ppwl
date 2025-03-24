<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
/*
|-------------------------------------------------------------------------
-
| Web Routes
|-------------------------------------------------------------------------
-
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route untuk Products & Carts
    //Route::resource('products', ProductController::class);
   // Route::resource('carts', CartController::class);
//});
    Route::resource('products', ProductController::class);
    Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    });


    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
    // Route untuk produk
    //Route::middleware(['auth', 'role:admin'])->group(function () {
    //Route::resource('products', ProductController::class);
//});
    
});
