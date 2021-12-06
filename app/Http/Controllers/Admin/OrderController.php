<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Enums\OrderStatus;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'orders.*',
                DB::raw('sum(order_items.quantity) as quantity'),
                DB::raw('sum(order_items.quantity * order_items.price) as total')
            )
            ->groupBy('orders.id')
            ->latest()
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }

    public function cancel(Order $order)
    {
        if (! $order->isCancellable() ) {
            return back()->with([
                'error' => 'The order can not be cancelled.'
            ]);
        }

        $order->is_cancelled = true;
        $order->cancelled_by = auth()->id();
        $order->save();

        return back()->with([
            'success' => 'Order successfully cancelled.'
        ]);
    }

    public function ship(Order $order)
    {
        if ($order->status !== OrderStatus::PREPARING) {
            return back()->with([
                'error' => 'Failed to ship the product',
            ]);
        }

        $order->status = OrderStatus::SHIPPED;
        $order->save();

        return back()->with([
            'success' => 'Order status updated',
        ]);

    }

    public function deliver(Order $order)
    {
        if ($order->status !== OrderStatus::SHIPPED) {
            return back()->with([
                'error' => 'Failed to deliver the product',
            ]);
        }

        $order->status = OrderStatus::DELIVERY;
        $order->save();

        return back()->with([
            'success' => 'Order status updated.'
        ]);
    }

    public function complete(Order $order)
    {
        if ($order->status !== OrderStatus::DELIVERY) {
            return back()->with([
                'error' => 'Failed to complete the order.'
            ]);
        }

        $order->status = OrderStatus::DELIVERED;
        $order->save();

        return back()->with([
            'success' => 'Order completed successfully'
        ]);
    }
}
