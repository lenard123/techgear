<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Cart;

class CartCard extends Component
{

    public $cart;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-card');
    }
}
