<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Address\HasAddress;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasAddress;

    protected $guarded = [
        'user_id',
        'status',
        'shipping_fee',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class)
            ->with('product');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCodeAttribute()
    {
        return "#" . str_pad($this->id, 7, "0", STR_PAD_LEFT);
    }

    public function subtotal()
    {
        $reducer = fn($acm, $item) => $acm + ($item->quantity * $item->price);
        return $this->order_items->reduce($reducer, 0);
    }

    /**
     * Use this function only on single model
     */
    public function grandTotal()
    {
        return $this->subtotal() + $this->shipping_fee;
    }

    public function getQrAttribute()
    {
        $link = urlencode(route('orders.show', $this));
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$link}&choe=UTF-8";
    }

    public function isCancellable()
    {
        //Order already cancelled
        if ($this->is_cancelled) return false;

        //If not logged in
        if (!auth()->user()) return false;

        /**
         * Order is not cancellable
         * by the customer once shipped
         */
        if (auth()->user()->isCustomer() && $this->status !== OrderStatus::PREPARING) return false;

        /**
         * Order is not cancellable
         * by the admin if the order is completed
         */
        if (!auth()->user()->isCustomer() && $this->status === OrderStatus::DELIVERED) return false;

        return true;
    }

    public static function calculateTotalSales()
    {
        $sales = self::select([
                DB::raw('sum(order_items.price * order_items.quantity) + sum(orders.shipping_fee) as total_sales'),
            ])
            ->join('order_items', 'orders.id', 'order_items.order_id')
            ->where('status', OrderStatus::DELIVERED)
            ->first();
        return $sales->total_sales;
    }

    public static function getOrderStatusReport()
    {
        $status_counts = self::select([
            DB::raw("count(case when is_cancelled is true then 1 end) as cancelled"),
            DB::raw("count(case when status = ". OrderStatus::PREPARING ." and is_cancelled is false then 1 end) as preparing"),
            DB::raw("count(case when status = ". OrderStatus::SHIPPED ." and is_cancelled is false then 1 end) as shipped"),
            DB::raw("count(case when status = ". OrderStatus::DELIVERY ." and is_cancelled is false then 1 end) as delivery"),
            DB::raw("count(case when status = ". OrderStatus::DELIVERED ." and is_cancelled is false then 1 end) as delivered"),
        ])->first();
        return $status_counts;
    }
}
