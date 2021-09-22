<?php

namespace App\Controllers;

use App\Components\CustomerPageComponent;
use App\Components\ProductCardComponent;

class ProductController extends BaseController
{

  private $product;

  public function __construct($product)
  {
    $this->product = $product;
  }

  public function get()
  {
    $product = $this->product;

    $view = new CustomerPageComponent("product_template");
    $view->addDescription($product->description ?? $product->name);
    $view->setTitle($product->name);
    $view->addData("product", $product);
    $view->render();
  }
}
