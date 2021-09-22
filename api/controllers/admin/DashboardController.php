<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminPageComponent;

class DashboardController extends BaseController
{
  public function get()
  {
    $view = new AdminPageComponent("dashboard_template");
    $view->render();
  }
}