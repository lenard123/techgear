<?php

use App\Utils\Route;
use App\Utils\Route2;

$web_routes = [
  "home" => Route::init(App\Controllers\HomeController::class),
  "category" => Route::init(App\Controllers\CategoryController::class)->setModel(App\Models\Category::class),
  "signout" => Route::init(App\Controllers\SignoutController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "signin" => Route::init(App\Controllers\SigninController::class)->addMiddleware(App\Middlewares\GuestCustomerOnlyMiddleware::class),
  "cart" => Route::init(App\Controllers\CartController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "signup" => Route::init(App\Controllers\SignupController::class)->addMiddleware(App\Middlewares\GuestCustomerOnlyMiddleware::class),
  "checkout" => Route::init(App\Controllers\CheckoutController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "order" => Route::init(App\Controllers\OrderController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "personal" => Route::init(App\Controllers\PersonalController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "settings" => Route::init(App\Controllers\SettingsController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "favorites" => Route::init(App\Controllers\FavoriteController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class),
  "product" => Route::init(App\Controllers\ProductController::class)->setModel(App\Models\Product::class),
  "order-details" => Route::init(App\Controllers\OrderDetailsController::class)->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class)->setModel(App\Models\Order::class),
  "search" => Route::init(App\Controllers\SearchController::class),
];

Route2::get("home")
  ->setController(App\Controllers\HomeController::class);

Route2::get("category")
  ->setController(App\Controllers\CategoryController::class)
  ->setModel(App\Models\Category::class);

Route2::post("signout")
  ->setController(App\Controllers\SignoutController::class)
  ->addMiddleware(App\Middlewares\CustomerOnlyMiddleware::class);

Route2::get("signin")
  ->setController(App\Controllers\SigninController::class)
  ->addMiddleware(App\Middlewares\GuestCustomerOnlyMiddleware::class);

Route2::post("signin")
  ->setController(App\Controllers\SigninController::class, "signin")
  ->addMiddleware(App\Middlewares\GuestCustomerOnlyMiddleware::class);