<?php

namespace App\Components;

use App\Models\User;
use App\Models\Category;

class CustomerHeaderComponent extends BaseComponent
{
  protected $template = 'customer_header';

  public function __construct()
  {
    $this->addData("categories", Category::getAll());

    if (User::isUserCustomer()) {
      $user = User::getCurrentUser();
      $this->addData("cart_count", $user->countCart());
      $this->addData("order_count", $user->countOrder());
      $this->addData("favorite_count", $user->countFavorites());
    }
  }

}