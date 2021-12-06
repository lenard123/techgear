<?php

namespace App\Observers;

use App\Models\Cart;

class CartObserver
{
    /**
     * Handle the Cart "updated" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        if ($cart->quantity <= 0)
            $cart->delete();
    }
}
