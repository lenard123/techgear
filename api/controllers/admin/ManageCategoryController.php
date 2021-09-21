<?php

import("controllers/BaseController");
import("components/AdminPageComponent");
import("models/Category");

class ManageCategoryController extends BaseController
{
  public function get()
  {
    $categories = Category::getAll();

    $view = new AdminPageComponent("category_template");
    $view->setActivePage("category");
    $view->addData("categories", $categories);
    $view->render();
  }
}