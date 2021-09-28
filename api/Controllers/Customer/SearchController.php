<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerLayoutComponent;
use App\Models\Product;

class SearchController extends BaseController
{

  public function get()
  {
    if (empty(get('query'))) return redirect("");

    $query = get('query');
    $result = Product::search($query);

    $view = new CustomerLayoutComponent("search_result_page");
    $view->addContentData("query", $query);
    $view->addContentData("result", $result);
    $view->setTitle("Search results for " . $query);
    
    $this->render($view);
  }

}
