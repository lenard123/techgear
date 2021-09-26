<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
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

    $content = new CustomerPageComponent("home_page");
    $content->setTitle("Home");
    $content->addData("slides", $slides);
    $content->addData("product_cards", $product_cards);
    $content->addScript(asset('js/slider.js'));

    $this->renderCustomerLayout($content);
  }
}
