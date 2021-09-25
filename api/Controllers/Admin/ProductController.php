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
    $view->addScript("https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js");
    $view->addScript(asset('js/admin-product-add.js'));
    $view->render();
  }

}