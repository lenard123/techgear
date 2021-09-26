<?php

namespace App\Components;

use App\Models\Product;

class ProductCardComponent extends BaseComponent
{

  protected $template = 'product_card';

  public function __construct(Product $product)
  {
    $this->addData('product', $product);
  }

  public static function mapProducts(Product ...$products)
  {
    return array_map(fn($product) => new ProductCardComponent($product), $products);

  }

}
