<?php

import("components/Component");
import("models/Category");
import("models/User");

class HeaderComponent extends Component
{
  protected $template = "header_template";

  public function __construct()
  {
    $this->addData("categories", Category::getAll());

    if (User::isUserCustomer()) {
      $this->addData("cart_count", User::getCurrentUser()->countCart());
      $this->addData("order_count", User::getCurrentUser()->countOrder());
    }

  }
}