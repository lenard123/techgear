<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\UserCartService;
use App\Http\Requests\Customer\CartStoreRequest;

class CartController extends Controller
{
    public function index()
    {

        $cartsData = new UserCartService(auth()->id());

        return view('customer.carts.index')
            ->with('cartsData', $cartsData);
    }

    public function increment(Cart $cart)
    {

        $this->authorize('update', $cart);

        $cart->increment('quantity');

        return redirect()
            ->route('carts.index')
            ->with('success', 'Cart item successfully incremented.');
    }

    public function decrement(Cart $cart)
    {

        $this->authorize('update', $cart);

        $cart->decrement('quantity');

        return redirect()
            ->route('carts.index')
            ->with('success', 'Cart item successfully decremented');
    }

    public function clear()
    {
        Cart::clearUserCarts(auth()->id());

        return redirect()
            ->route('carts.index')
            ->with('success', 'Cart successfully cleared.');
    }

    public function store(CartStoreRequest $request)
    {

        $cartData = [
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
        ];

        Cart::firstOrCreate($cartData);

        return redirect()
            ->route('carts.index')
            ->with('success', 'Item added successfully.');
    }
}
