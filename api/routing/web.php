<?php

use App\Utils\Route;

//For Guest User
Route::get("home")
  ->setController(App\Controllers\Customer\HomeController::class);

Route::get("category")
  ->setController(App\Controllers\Customer\CategoryController::class)
  ->setModel(App\Models\Category::class);

Route::get('product')
  ->setController(App\Controllers\Customer\ProductController::class, "get")
  ->setModel(App\Models\Product::class);

Route::get("search")
  ->setController(App\Controllers\Customer\SearchController::class, "get");

//Authentication
Route::post("signout")
  ->setController(App\Controllers\Customer\SignoutController::class)
  ->customerOnly();

Route::get("signin")
  ->setController(App\Controllers\Customer\SigninController::class)
  ->guestCustomerOnly();
Route::post("signin")
  ->setController(App\Controllers\Customer\SigninController::class, "signin")
  ->guestCustomerOnly();

Route::get("signup")
  ->setController(App\Controllers\Customer\SignupController::class)
  ->guestCustomerOnly();
Route::post("signup")
  ->setController(App\Controllers\Customer\SignupController::class, "process")
  ->guestCustomerOnly();

//Cart
Route::get('cart')
  ->setController(App\Controllers\Customer\CartController::class)
  ->customerOnly();
Route::put('cart')
  ->setController(App\Controllers\Customer\CartController::class, "put")
  ->customerOnly();
Route::delete("cart")
  ->setController(App\Controllers\Customer\CartController::class, "delete")
  ->customerOnly();
Route::patch("cart")
  ->setController(App\Controllers\Customer\CartController::class, "patch")
  ->customerOnly();

//Checkout
Route::get('checkout')
  ->setController(App\Controllers\Customer\CheckoutController::class, "get")
  ->customerOnly();
Route::post('checkout')
  ->setController(App\Controllers\Customer\CheckoutController::class, "post")
  ->customerOnly();

//Order
Route::get('order')
  ->setController(App\Controllers\OrderController::class, "get")
  ->customerOnly();

//Profile
Route::get('personal')
  ->setController(App\Controllers\PersonalController::class, "get")
  ->customerOnly();
Route::patch('personal')
  ->setController(App\Controllers\PersonalController::class, "patch")
  ->customerOnly();

//Settings
Route::get('settings')
  ->setController(App\Controllers\SettingsController::class, "get")
  ->customerOnly();
Route::patch('settings')
  ->setController(App\Controllers\SettingsController::class, "get")
  ->customerOnly();

//Favorites
Route::get('favorites')
  ->setController(App\Controllers\FavoriteController::class, "get")
  ->customerOnly();
Route::delete("favorites")
  ->setController(App\Controllers\FavoriteController::class, "delete")
  ->customerOnly();
Route::post("favorites")
  ->setController(App\Controllers\FavoriteController::class, "post")
  ->customerOnly();

//Order Details
Route::get('order-details')
  ->setController(App\Controllers\OrderDetailsController::class, "get")
  ->setModel(App\Models\Order::class)
  ->customerOnly();
