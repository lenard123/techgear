<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminPageComponent;
use App\Models\Product;

class ProductController extends BaseController
{

  public function __invoke()
  {
    $products = Product::getAll();

    $view = new AdminPageComponent("product_template");
    $view->addData("products", $products);
    $view->render();
  }

  public function add()
  {
    $view = new AdminPageComponent("product_add_template");
    $view->render();
  }

}