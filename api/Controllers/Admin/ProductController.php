<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminLayoutComponent;
use App\Models\Product;

class ProductController extends BaseController
{

  public function __invoke()
  {
    $products = Product::getAll();
    $view = new AdminLayoutComponent("product_page");
    $view->addContentData("products", $products);
    $this->render($view);
  }

  public function add()
  {
    $view = new AdminLayoutComponent("product_add_page");
    $view->addScript("https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js");
    $view->addScript(asset('js/admin-product-add.js'));
    $this->render($view);
  }

}