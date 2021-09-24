<?php

use App\Utils\Route;

$admin_routes = [
  "home" => Route::init(App\Controllers\Admin\DashboardController::class),
  "category" => Route::init(App\Controllers\Admin\ManageCategoryController::class),
];
