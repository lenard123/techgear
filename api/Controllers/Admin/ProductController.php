<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminLayoutComponent;
use App\Models\Product;
use App\Models\Category;

class ProductController extends BaseController
{

  public function __invoke()
  {
    $products = Product::getAll();
    $view = new AdminLayoutComponent("product_page");
    $view->addContentData("products", $products);
    $this->render($view);
  }

  public function addPage()
  {
    $view = new AdminLayoutComponent("product_add_page");
    $view->addCustomScript("https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js", false);
    $view->addCustomScript('js/admin-product-add.js');
    $view->addContentData('categories', Category::getAll());
    $this->render($view);
  }

  public function add()
  {
    $product = new Product;
    $product->name = post('name');
    $product->category_id = post('category_id');
    $product->price = post('price');
    $product->quantity = post('quantity');
    $product->save();
    redirect('?page=products', 'admin');
  }

}