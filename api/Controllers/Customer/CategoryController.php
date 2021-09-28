<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerLayoutComponent;

class CategoryController extends BaseController
{

  private $category;

  public function __construct($category)
  {
    $this->category = $category;
  }

  public function __invoke()
  {
    $view = new CustomerLayoutComponent('category_page');
    $view->setTitle($this->category->name);
    $view->addContentData('category', $this->category);

    $this->render($view);
  }
}
