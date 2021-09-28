<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\ProfilePageComponent;
use App\Components\CustomerLayoutComponent;
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

    $page = new ProfilePageComponent('order_details_page', 'order');
    $page->addContentData('order', $order);
    $page->addContentData('items', $items);

    $view = new CustomerLayoutComponent($page);
    $view->setTitle('Order Details');
    $view->addJSData('order_status', $order->status);
    $view->addCustomScript('js/order-details.js');

    $this->render($view);
  }
}