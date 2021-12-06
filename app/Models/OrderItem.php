<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subtotal()
    {
        return $this->price * $this->quantity;
    }
}
