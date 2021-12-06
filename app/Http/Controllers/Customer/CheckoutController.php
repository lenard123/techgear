<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CheckoutRequest;
use Yajra\Address\Entities\Region;
use App\Services\UserCartService;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\UserAddressService;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $user = auth()->user();
        $user_info = $user->info();
        $cartsData = new UserCartService(auth()->id());

        $address = new UserAddressService($user);

        return view('customer.checkout.index', [
            'user' => $user,
            'user_info' => $user_info,
            'cartsData' => $cartsData,
            'address' => $address
        ]);
    }

    public function proccessOrder(CheckoutRequest $request)
    {
        $order = new Order;
        $order->user_id = auth()->id();
        $order->status = OrderStatus::PREPARING;
        $order->shipping_fee = config('site.shipping_fee');
        $order->fill($request->validated());
        $order->save();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order place successfully.');
    }
}
