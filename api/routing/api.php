<?php

use App\Utils\Route;
use App\Controllers;

Route::get("location")
  ->setController(App\Controllers\LocationController::class, "get");
