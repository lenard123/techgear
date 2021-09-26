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
    $this->render($layout);
  }

  public function render(BaseComponent $page)
  {
    echo $page->render();
  }
}