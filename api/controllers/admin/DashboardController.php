<?php

import("controllers/BaseController");
import("Components/AdminPageComponent");

class DashboardController extends BaseController
{
  public function get()
  {
    $view = new AdminPageComponent("dashboard_template");
    $view->render();
  }
}