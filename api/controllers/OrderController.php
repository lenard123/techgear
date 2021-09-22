<?php

namespace App\Controllers;

use App\Components\ProfilePageComponent;
use App\Models\Order;
use App\Models\User;

class OrderController extends BaseController
{
  public function get()
  {

    $orders = User::getCurrentUser()->getOrders();

    $view = new ProfilePageComponent("order_template");
    $view->setTitle("Orders");
    $view->addData("orders", $orders);
    $view->setActivePage("order");
    $view->render();
  }
}