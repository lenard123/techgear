<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerPageComponent;

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

    $view = new CustomerPageComponent("category_page");
    $view->setTitle($category->name);
    $view->addData("category", $category);
    
    $this->renderCustomerLayout($view);
  }
}
