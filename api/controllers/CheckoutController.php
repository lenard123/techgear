<?php

import("controllers/BaseController");
import("controllers/LocationController");
import("components/CustomerPageComponent");
import("models/User");
import("models/Order");
import("utils/ValidatorList");

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
    $total = SITE_SHIPPING_FEE + $subtotal;
    $validator = $this->validator;

    if (count($carts) <= 0) {
      redirect("?page=cart");
    } else {
      $view = new CustomerPageComponent("checkout_template");
      $view->setTitle("Checkout");
      $view->addData("user", $user);
      $view->addData("user_info", $user_info);
      $view->addData("carts", $carts);
      $view->addData("subtotal", $subtotal);
      $view->addData("total", $total);
      $view->addData("regions", $regions);
      $view->addData("validator", $validator);
      $view->addScript('https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js');
      $view->addScript('https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js');
      $view->addScript(asset('js/address.js'));

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

      $view->render();
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
    $order->shipping_fee = SITE_SHIPPING_FEE;
    $order->save();

    dd($order);
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