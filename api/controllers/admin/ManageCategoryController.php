<?php

import("controllers/BaseController");
import("components/AdminPageComponent");

class ManageCategoryController extends BaseController
{
  public function get()
  {
    $view = new AdminPageComponent;
    $view->render();
  }
}