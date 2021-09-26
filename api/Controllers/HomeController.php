<?php

namespace App\Controllers;

use App\Components\CustomerPageComponent;
use App\Components\ProductCardComponent;
use App\Models\Product;

class HomeController extends BaseController
{
  public function __invoke()
  {
    $slides = [
      asset('img/slide1.jpg'),
      asset('img/slide2.jpg'),
      asset('img/slide3.jpg'),
      asset('img/slide4.jpg'),
      asset('img/slide5.jpg'),
      asset('img/slide6.jpg'),
      asset('img/slide7.jpg'),
    ];

    $featured_products = Product::getFeaturedProducts();
    $product_cards = ProductCardComponent::mapProducts(...$featured_products);

    $view = new CustomerPageComponent("home_template");
    $view->setTitle("Home");
    $view->addData("slides", $slides);
    $view->addData("product_cards", $product_cards);
    $view->addScript(asset('js/slider.js'));
    $view->render();
  }
}
