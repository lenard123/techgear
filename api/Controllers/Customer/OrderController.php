<?php

namespace App\Controllers\Customer;

use App\Models\User;
use App\Components\ProfilePageComponent;

class OrderController extends CustomerController
{
  public function __invoke()
  {
    $orders = User::getCurrentUser()->getOrders();

    $view = new ProfilePageComponent('order_page');
    $view->setTitle("Orders");
    $view->setActivePage('order');
    $view->addContentData("orders", $orders);
    $this->render($view);
  }
}