<?php

namespace App\Components;

use App\Models\Category;
use App\Models\User;

class HeaderComponent extends Component
{
  protected $template = "header_template";

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