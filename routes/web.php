<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\FavoriteController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\SettingsController;
use App\Http\Controllers\Customer\Auth\SignupController;
use App\Http\Controllers\Customer\Auth\LogoutController;
use App\Http\Controllers\Customer\Auth\LoginController;

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


/**
 * Public Routes
 */
Route::get('/', HomeController::class)->name('home');
Route::get('/home', HomeController::class);

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/** 
 * Guest Only Routes
 */
Route::middleware('guest')->group(function() {

  Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [LoginController::class, 'login']);

  Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
  Route::post('/signup', [SignupController::class, 'signup']);
});


Route::middleware('auth')->group(function() {

  Route::get('/logout', LogoutController::class)->name('logout');

  Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
  Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
  Route::delete('/carts', [CartController::class, 'clear'])->name('carts.clear');
  Route::patch('/carts/{cart}/increment', [CartController::class, 'increment'])
    ->middleware('productOrderLimit')
    ->name('carts.increment');
  Route::patch('/carts/{cart}/decrement', [CartController::class, 'decrement'])->name('carts.decrement');


  Route::get('/check-out', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
  Route::post('/check-out', [CheckoutController::class, 'proccessOrder']);

  Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
  Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

  Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
  Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
  Route::delete('/favorites/{favorite}', [FavoriteController::class, 'delete'])->name('favorites.delete');

  Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
  Route::patch('/settings/email', [SettingsController::class, 'updateEmail'])->name('settings.updateEmail');
  Route::patch('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');

  Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::patch('/profile/contact', [ProfileController::class, 'updateContact'])->name('profile.updateContact');
  Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.updateAddress');

});

include 'admin.php';