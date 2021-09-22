<?php

use App\Utils\Route;

$admin_routes = [
  "home" => Route::admin('DashboardController'),
  "category" => Route::admin('ManageCategoryController'),
];
