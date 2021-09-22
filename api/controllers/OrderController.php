<?php

import("controllers/BaseController");
import("Components/ProfilePageComponent");
import("models/User");

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