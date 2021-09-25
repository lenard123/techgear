<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminPageComponent;
use App\Models\Product;

class DashboardController extends BaseController
{
  public function get()
  {
    $view = new AdminPageComponent("dashboard_template");
    $view->addData("featured_products", Product::getFeaturedProducts());
    $view->render();
  }
}