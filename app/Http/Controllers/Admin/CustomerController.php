<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {

        $customers = User::with('image')
//            ->where('role', UserRole::CUSTOMER)
            ->get();

        return view('admin.customers.index', [
            'customers' => $customers
        ]);
    }

    public function profile(User $user)
    {
        abort_if($user->role !== UserRole::CUSTOMER, 404);

        return view('admin.customers.profile', [
            'customer' => $user,
            'customer_info' => $user->info()
        ]);
    }

    public function orders(User $user)
    {
        abort_if($user->role !== UserRole::CUSTOMER, 404);

        $orders = $user
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

        return view('admin.customers.orders', [
            'customer' => $user,
            'orders' => $orders
        ]);
    }

    public function favorites(User $user)
    {
        abort_if($user->role !== UserRole::CUSTOMER, 404);

        $favorites = $user->favorites()->with('product')->get();

        return view('admin.customers.favorites', [
            'customer' => $user,
            'favorites' => $favorites
        ]);
    }
}
