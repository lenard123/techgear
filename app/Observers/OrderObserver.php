<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $cartItems = Cart::getUserCarts($order->user_id);

        foreach($cartItems as $item)
        {
            //Place Order
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->product->price;
            $orderItem->save();

            //Remove from cart
            $item->delete();
        }

    }
}
