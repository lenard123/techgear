<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerPageComponent1;
use App\Components\CustomerLayoutComponent;

class CustomerController extends BaseController
{
  public function render(CustomerPageComponent1 $content)
  {
    $layout = new CustomerLayoutComponent($content);
    return $layout->render($content);
  }
}