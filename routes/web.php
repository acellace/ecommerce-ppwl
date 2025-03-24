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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   
    Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
   // Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
   // Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    });

    Route::resource('carts', CartController::class);
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Ubah dari 'carts.index' ke 'cart.index'

    
    
    //Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('carts.add');
    //Route::post('/cart/update/{cartId}', [CartController::class, 'update'])->name('carts.update');
    //Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('carts.remove');
   
    });
    

