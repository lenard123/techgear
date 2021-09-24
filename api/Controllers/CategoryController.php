<?php

namespace App\Controllers;

use App\Components\CustomerPageComponent;
use App\Components\ProductCardComponent;

class CategoryController extends BaseController
{

  private $category;

  public function __construct($category)
  {
    $this->category = $category;
  }

  public function __invoke()
  {
    $category = $this->category;

    $view = new CustomerPageComponent("category_template");
    $view->setTitle($category->name);
    $view->addData("category", $category);
    $view->render();
  }
}
