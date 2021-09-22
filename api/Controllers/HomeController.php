<?php

namespace App\Controllers;

use App\Components\CustomerPageComponent;
use App\Components\ProductCardComponent;
use App\Models\Product;

class HomeController extends BaseController
{
  public function get()
  {
    $slides = [
      asset('img/slide1.jpg'),
      asset('img/slide2.jpg'),
      asset('img/slide3.jpg'),
    ];

    $featured_products = Product::getFeaturedProducts();

    $view = new CustomerPageComponent("home_template");
    $view->setTitle("Home");
    $view->addData("slides", $slides);
    $view->addData("featured_products", $featured_products);
    $view->addScript(asset('js/slider.js'));
    $view->render();
  }
}
