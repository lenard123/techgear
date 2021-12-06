<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Enums\OrderStatus;

class OrderController extends Controller
{
    public function index()
    {

        $orders = auth()
            ->user()
            ->orders()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'orders.*',
                DB::raw('sum(order_items.quantity) as quantity'),
                DB::raw('sum(order_items.quantity * order_items.price) as total')
            )
            ->groupBy('orders.id')
            ->latest()
            ->get();

        return view('customer.orders.index')
            ->with('orders', $orders);
    }

    public function show(Order $order)
    {
        return view('customer.orders.show')
            ->with('order', $order);
    }
}
