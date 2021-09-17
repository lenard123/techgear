<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");
import("components/ProductCardComponent");

class CategoryController extends BaseController
{

  private $category;

  public function __construct($category)
  {
    $this->category = $category;
  }

  public function get()
  {
    $category = $this->category;

    $view = new CustomerPageComponent("category_template");
    $view->setTitle($category->name);
    $view->addData("category", $category);
    $view->render();
  }
}
