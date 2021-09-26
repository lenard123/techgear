<?php

namespace App\Controllers\Customer;

use App\Components\CustomerPageComponent1;
use App\Models\Product;

class SearchController extends CustomerController
{

  public function get()
  {
    if (empty(get('query'))) return redirect("");

    $query = get('query');
    $result = Product::search($query);

    $view = new CustomerPageComponent1("search_result_page");
    $view->addData("query", $query);
    $view->addData("result", $result);
    $view->setTitle("Search results for " . $query);
    
    $this->render($view);
  }

}
