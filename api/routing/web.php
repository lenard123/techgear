<?php

use App\utils\Route;

$web_routes = [
  "home" => Route::init('HomeController'),
  "category" => Route::init('CategoryController')->setModel('Category'),
  "signout" => Route::init('SignoutController')->addMiddleware('CustomerOnlyMiddleware'),
  "signin" => Route::init('SigninController')->addMiddleware('GuestCustomerOnlyMiddleware'),
  "cart" => Route::init('CartController')->addMiddleware('CustomerOnlyMiddleware'),
  "signup" => Route::init('SignupController')->addMiddleware('GuestCustomerOnlyMiddleware'),
  "checkout" => Route::init('CheckoutController')->addMiddleware('CustomerOnlyMiddleware'),
  "order" => Route::init('OrderController')->addMiddleware('CustomerOnlyMiddleware'),
  "personal" => Route::init('PersonalController')->addMiddleware('CustomerOnlyMiddleware'),
  "settings" => Route::init('SettingsController')->addMiddleware('CustomerOnlyMiddleware'),
  "favorites" => Route::init('FavoriteController')->addMiddleware('CustomerOnlyMiddleware'),
  "product" => Route::init('ProductController')->setModel('Product'),
  "order-details" => Route::init('OrderDetailsController')->addMiddleware('CustomerOnlyMiddleware')->setModel('Order'),
  "search" => Route::init('SearchController'),
];

