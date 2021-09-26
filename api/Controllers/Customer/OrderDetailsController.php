<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
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

    $view = new ProfilePageComponent("order_details_page");
    $view->setTitle("Order Details");
    $view->setActivePage("order");
    $view->addContentData("order", $order);
    $view->addContentData("items", $items);
    $view->addJSData("order_status", $order->status);
    $view->addScript(asset('js/order-details.js'));
    
    $this->renderCustomerLayout($view);
  }
}