<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");

class ProductController extends BaseController
{

  public function get()
  {

    $view = new CustomerPageComponent("product_template");
    $view->render();

  }
}
