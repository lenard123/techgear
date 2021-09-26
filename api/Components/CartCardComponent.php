<?php

namespace App\Components;

use App\Models\Cart;

class CartCardComponent extends BaseComponent
{
  protected $template = "cart_card";

  public function __construct(Cart $cart)
  {
    $this->addData("cart", $cart);
  }
}