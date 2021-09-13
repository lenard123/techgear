<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");
import("components/ProductCardComponent");
import("models/Product");

class HomeController extends BaseController
{
  public function get()
  {
    $featured_products = Product::getFeaturedProducts();

    $view = new CustomerPageComponent("home_template");
    $view->setTitle("Home");
    $view->addData("featured_products", $featured_products);
    $view->render();
  }
}
