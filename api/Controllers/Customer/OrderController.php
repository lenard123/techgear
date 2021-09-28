<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\User;
use App\Components\ProfilePageComponent;
use App\Components\CustomerLayoutComponent;

class OrderController extends BaseController
{
  public function __invoke()
  {
    $orders = User::getCurrentUser()->getOrders();

    $profilePage = new ProfilePageComponent('order_page', 'order');
    $profilePage->addContentData('orders', $orders);

    $view = new CustomerLayoutComponent($profilePage);
    $view->setTitle('Orders');

    $this->render($view);
  }
}
