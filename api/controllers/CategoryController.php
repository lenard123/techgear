<?php

import("controllers/BaseController");
import("Components/CustomerPageComponent");
import("Components/ProductCardComponent");

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
