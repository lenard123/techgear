<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;

class ProductOrderLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = $request->route()->parameter('cart');

        if ($cart->canIncrement())
            return $next($request);

        return back()
            ->with('error', 'You reached the maximum number of order for this item.');
    }
}
