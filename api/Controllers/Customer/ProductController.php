<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerLayoutComponent;

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

    $view = new CustomerLayoutComponent("product_page");
    $view->addMetaData('description', $product->description ?? $product->name);
    $view->setTitle($product->name);
    $view->addContentData("product", $product);

    $this->render($view);
  }
}
