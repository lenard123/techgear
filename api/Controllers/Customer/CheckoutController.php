<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Controllers\LocationController;
use App\Components\CustomerLayoutComponent;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Utils\AlertMessage;
use App\Utils\ValidatorList;

class CheckoutController extends BaseController
{

  public $validator = null;

  public function __construct()
  {
    $this->validator = new ValidatorList;
  }

  public function get()
  {
    $user = User::getCurrentUser();
    $user_info = $user->getUserInfo();
    $carts = $user->getCarts();
    $subtotal = Cart::calculateSubtotal($carts);
    $regions = LocationController::$regions;
    $total = config('app.shipping_fee') + $subtotal;
    $validator = $this->validator;

    if (count($carts) <= 0) {
      redirect("?page=cart");
    } else {

      $view = new CustomerLayoutComponent("checkout_page");
      $view->setTitle("Checkout");
      $view->addContentData("user", $user);
      $view->addContentData("user_info", $user_info);
      $view->addContentData("carts", $carts);
      $view->addContentData("subtotal", $subtotal);
      $view->addContentData("total", $total);
      $view->addContentData("regions", $regions);
      $view->addContentData("validator", $validator);
      $view->addJSLibrary('axios');
      $view->addCustomScript('js/address.js');

      if (!is_null($user_info->region) && LocationController::isValidRegion($user_info->region)) {
        $region = $user_info->region;
        $view->addJSData("region_data", LocationController::getLocation()->$region);
        $view->addJSData("region", $region);
        if (!is_null($user_info->province)) {
          $view->addJSData("province", $user_info->province);
          if (!is_null($user_info->municipality)) {
            $view->addJSData("municipality", $user_info->municipality);
            if (!is_null($user_info->barangay)) {
              $view->addJSData("barangay", $user_info->barangay);
            }
          }
        }
      }

      $this->render($view);
    }
  }

  public function post()
  {
    $this->validate();

    if ($this->validator->hasError()) {
      return $this->get();
    }

    $order = new Order;
    $order->user_id = User::getCurrentUser()->id;
    $order->status = Order::STATUS_PREPARING;
    $order->recipient_firstname = post('recipient_firstname');
    $order->recipient_lastname = post('recipient_lastname');
    $order->region = post('region');
    $order->province = post('province');
    $order->municipality = post('municipality');
    $order->barangay = post('barangay');
    $order->street = post('street');
    $order->unit = post('unit');
    $order->phone = post('phone');
    $order->email = post('email');
    $order->shipping_fee = config('app.shipping_fee');
    $order->save();

    AlertMessage::success('Order placed successfully');
    redirect("?page=order-details&id={$order->id}");
  }

  public function validate()
  {
    $this->validator->add("recipient_firstname", "required|min:2|max:30|name", "Firstname");
    $this->validator->add("recipient_lastname", "required|min:2|max:30|name", "Lastname");
    $this->validator->add("phone", "required|max:11", "Phone Number");
    $this->validator->add("email", "required|email|max:100", "Email");
    $this->validator->add("region", "required", "Region");
    $this->validator->add("province", "required", "Province");
    $this->validator->add("municipality", "required", "City");
    $this->validator->add("street", "required|max:500", "Street");
    $this->validator->add("unit", "required|max:500", "Unit");
  }

}
