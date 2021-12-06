<?php

namespace App\Enums;

class OrderStatus extends Enum
{
    const PREPARING = 1;
    const SHIPPED = 2;
    const DELIVERY = 3;
    const DELIVERED = 4;
}