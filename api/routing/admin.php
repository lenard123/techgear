<?php

use App\Utils\Route;

Route::get("home")
  ->setController(App\Controllers\Admin\DashboardController::class, "get");

Route::get("category")
  ->setController(App\Controllers\Admin\ManageCategoryController::class, "get");
Route::patch("category")
  ->setController(App\Controllers\Admin\ManageCategoryController::class, "updateCategory")
  ->setModel(App\Models\Category::class);
