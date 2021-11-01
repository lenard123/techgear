<?php

namespace App\Services;

use App\Models\Cart;

class UserCartService
{

    public $items;

    public $shippingFee;

    public $subtotal;

    public $total;

    public function __construct($user_id)
    {
        $this->items = Cart::getUserCarts($user_id);
        $this->shippingFee = config('site.shipping_fee');
        $this->calculateSubtotal();
        $this->calculateTotal();
    }

    public function calculateSubtotal()
    {
        $this->subtotal = $this->items->sum(fn($item) => $item->calculateSubtotal());
    }

    public function calculateTotal()
    {
        $this->total = $this->subtotal + $this->shippingFee;
    }

}