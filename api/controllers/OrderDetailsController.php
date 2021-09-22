<?php

namespace App\Controllers;

use App\Components\ProfilePageComponent;
use App\Models\Order;

class OrderDetailsController extends BaseController
{

  private $order;

  public function __construct($order)
  {
    $this->order = $order;
  }

  public function get()
  {
    $order = $this->order;
    $items = $order->getItems();

    $view = new ProfilePageComponent("order_details_template");
    $view->setTitle("Order Details");
    $view->setActivePage("order");
    $view->addData("order", $order);
    $view->addData("items", $items);
    $view->addJSData("order_status", $order->status);
    $view->addScript(asset('js/order-details.js'));
    $view->render();
  }
}