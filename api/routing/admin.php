<?php

import("utils/Route");

$admin_routes = [
  "home" => Route::admin('DashboardController'),
  "category" => Route::admin('ManageCategoryController'),
];
