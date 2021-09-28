<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\ProductCardComponent;
use App\Components\CustomerLayoutComponent;
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

    $view = new CustomerLayoutComponent("home_page");
    $view->setTitle('Home');
    $view->addContentData('product_cards', $product_cards);
    $view->addJSData('slides', $slides);
    $view->addCustomScript('js/slider.js');

    $this->render($view);
  }
}
