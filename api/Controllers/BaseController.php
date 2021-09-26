<?php

namespace App\Controllers;

use App\Components\BaseComponent;
use App\Components\CustomerPageComponent;
use App\Components\CustomerLayoutComponent;

class BaseController
{

  public function renderCustomerLayout(CustomerPageComponent $page)
  {
    $layout = new CustomerLayoutComponent($page);
    echo $layout->render();
  }

  public function render(BaseComponent $page)
  {
    echo $page->render();
  }
}