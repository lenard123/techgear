<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Address\HasAddress;

class UserInfo extends Model
{
    use HasAddress;

    protected $table = 'user_info';

    protected $fillable = [
        'user_id',
        'region_id',
        'province_id',
        'city_id',
        'barangay_id',
        'street',
        'unit'
    ];

}
