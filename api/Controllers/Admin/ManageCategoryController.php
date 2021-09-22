<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminPageComponent;
use App\Models\Category;

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