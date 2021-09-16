<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");
import("components/ProductCardComponent");

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
    $view->setTitle($product->name);
    $view->addData("product", $product);
    $view->render();
  }
}
