<?php

use App\Utils\Route;
use App\Controllers;

$api_routes = [
  "location" => Route::init(Controllers\LocationController::class),
];
