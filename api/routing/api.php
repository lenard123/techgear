<?php

use App\Utils\Route;

Route::get("location")
  ->setController(App\Controllers\LocationController::class, "get");