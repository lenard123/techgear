<?php

import("Route");

$web_routes = [
  "home" => Route::init('HomeController'),
  "subcategory" => Route::init('SubcategoryController')->setModel('Subcategory'),
  "signout" => Route::init('SignoutController')->addMiddleware('CustomerOnlyMiddleware'),
  "signin" => Route::init('SigninController')->addMiddleware('GuestCustomerOnlyMiddleware'),
  "cart" => Route::init('CartController')->addMiddleware('CustomerOnlyMiddleware'),
  "signup" => Route::init('SignupController')->addMiddleware('GuestCustomerOnlyMiddleware'),
  "checkout" => Route::init('CheckoutController')->addMiddleware('CustomerOnlyMiddleware'),
  "order" => Route::init('OrderController')->addMiddleware('CustomerOnlyMiddleware'),
  "personal" => Route::init('PersonalController')->addMiddleware('CustomerOnlyMiddleware'),
];

