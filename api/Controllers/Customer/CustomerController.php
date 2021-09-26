<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerPageComponent;
use App\Components\CustomerLayoutComponent;

class CustomerController extends BaseController
{
  public function render(CustomerPageComponent $content)
  {
    $layout = new CustomerLayoutComponent($content);
    echo $layout->render($content);
  }
}