<?php

namespace App\Components;

class ProductCardComponent extends Component
{
  protected $template = "product_card_template";

  public function __construct($product)
  {
    $this->addData("product", $product);
  }
}