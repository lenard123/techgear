<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
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

Route::get('/', HomeController::class)->name('home');
Route::get('/home', HomeController::class);

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

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

});
