<?php

namespace App\Controllers\Customer;

use App\Components\CustomerPageComponent1;

class ProductController extends CustomerController
{

  private $product;

  public function __construct($product)
  {
    $this->product = $product;
  }

  public function get()
  {
    $product = $this->product;

    $view = new CustomerPageComponent1("product_page");
    $view->addDescription($product->description ?? $product->name);
    $view->setTitle($product->name);
    $view->addData("product", $product);
    $this->render($view);
  }
}