<?php

import("controllers/BaseController");
import("components/AdminPageComponent");

class DashboardController extends BaseController
{
  public function get()
  {
    $view = new AdminPageComponent;
    $view->render();
  }
}