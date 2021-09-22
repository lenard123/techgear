<?php

import("Components/Component");

class CartCardComponent extends Component
{
  protected $template = "cart_card_template";

  public function __construct($cart)
  {
    $this->addData("cart", $cart);
  }
}