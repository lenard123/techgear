<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerPageComponent;

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

    $view = new CustomerPageComponent("product_page");
    $view->addDescription($product->description ?? $product->name);
    $view->setTitle($product->name);
    $view->addData("product", $product);
    $this->renderCustomerLayout($view);
  }
}
