<?php

namespace App\Controllers\Customer;

use App\Components\CustomerPageComponent1;

class CategoryController extends CustomerController
{

  private $category;

  public function __construct($category)
  {
    $this->category = $category;
  }

  public function __invoke()
  {
    $category = $this->category;

    $view = new CustomerPageComponent1("category_page");
    $view->setTitle($category->name);
    $view->addData("category", $category);
    
    $this->render($view);
  }
}
