<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\OrderController;
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

//Admin Routes
	Route::prefix('admin')->group(function () {
	    	Route::get('login', [AdminLoginController::class,'login'])->name('adminLogin');
			Route::post('login', [AdminLoginController::class,'adminLogin']);

			Route::group(['middleware' => 'auth:admin'], function () {
				Route::post('logout', [AdminLoginController::class,'logout']);
				Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

				Route::get('orders', [AdminOrderController::class,'index'])->name('orders');
				Route::get('orders/get-orders', [AdminOrderController::class,'getOrders']);
				Route::get('orders/{id}', [AdminOrderController::class,'showOrderDetails']);

				Route::get('products/get-products', [ProductController::class,'getProducts']);
				Route::resource('products', Admin\ProductController::class);
	    	});
	});
//End Admin routes

//Auth Routes
	Auth::routes();
//End Auth routes

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('products', [HomeController::class, 'showProducts'])->name('products');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::get('cart', [CartController::class, 'showCart'])->name('cart');
Route::post('cart-validation', [CartController::class, 'cartValidation'])->name('cart-validation');

Route::group(['middleware' => 'auth'], function () {
	Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
	Route::post('order', [OrderController::class, 'placeOrder'])->name('order');
});