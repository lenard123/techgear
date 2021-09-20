<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");

class SearchController extends BaseController
{

  public function get()
  {
    $view = new CustomerPageComponent("search_result_template");
    $view->render();
  }

}
