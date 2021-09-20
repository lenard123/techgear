<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");
import("components/ProductCardComponent");
import("models/Product");

class SearchController extends BaseController
{

  public function get()
  {
    if (empty(get('query'))) return redirect("");

    $query = get('query');
    $result = Product::search($query);

    $view = new CustomerPageComponent("search_result_template");
    $view->addData("query", $query);
    $view->addData("result", $result);
    $view->setTitle("Search results for " . $query);
    $view->render();
  }

}
