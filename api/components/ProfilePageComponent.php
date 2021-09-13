<?php

import("components/CustomerPageComponent");
import("models/User");

class ProfilePageComponent extends CustomerPageComponent
{

  public $profile_content_data = [];

  public function __construct($template)
  {
    $user = User::getCurrentUser();
    $order_count = $user->countOrder();

    parent::addData("user", $user);
    parent::addData("order_count", $order_count);
    parent::addData("content", $template);
    parent::addData("content_data", $this->profile_content_data);
    parent::__construct("profile_page_template");
  }

  public function addData($key, $value)
  {
    $this->profile_content_data[$key] = $value;
    parent::addData("content_data", $this->profile_content_data);
  }

  public function setActivePage($active)
  {
    parent::addData("active", $active);
  }
}