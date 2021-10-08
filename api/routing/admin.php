<?php

use App\Utils\Route;

Route::get("home")
  ->setController(App\Controllers\Admin\DashboardController::class, "get");

Route::get("category")
  ->setController(App\Controllers\Admin\ManageCategoryController::class, "get");
Route::patch("category")
  ->setController(App\Controllers\Admin\ManageCategoryController::class, "updateCategory")
  ->setModel(App\Models\Category::class);

Route::get("products")
  ->setController(App\Controllers\Admin\ProductController::class);
Route::get("products-add")
  ->setController(App\Controllers\Admin\ProductController::class, "addPage");
Route::post("products-add")
  ->setController(App\Controllers\Admin\ProductController::class, "add");

Route::get("signin")
  ->setController(App\Controllers\Admin\SigninController::class);

Route::post("signin")
  ->setController(App\Controllers\Admin\SigninController::class, "process");