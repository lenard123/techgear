<?php

namespace App\Controllers\Customer;

use App\Models\User;
use App\Components\ProfilePageComponent1;

class OrderController extends CustomerController
{
  public function __invoke()
  {
    $orders = User::getCurrentUser()->getOrders();

    $view = new ProfilePageComponent1('order_page');
    $view->setTitle("Orders");
    $view->setActivePage('order');
    $view->addContentData("orders", $orders);
    $this->render($view);
  }
}