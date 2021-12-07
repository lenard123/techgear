<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Enums\UserRole;
use App\Enums\OrderStatus;


class DashboardService
{

    private $customers_count;

    private $complete_orders_count;

    private $products_count;

    private $published_products_count;

    private $unpublished_products_count;

    private $total_sales;

    public function __construct()
    {
        $this->customers_count = User::where('role', UserRole::CUSTOMER)->count();
        $this->complete_orders_count = Order::where('status', OrderStatus::DELIVERED)->count();
        $this->products_count = Product::count();
        $this->published_products_count = Product::where('is_published', true)->count();
        $this->unpublished_products_count = $this->products_count - $this->published_products_count;
        $this->total_sales = Order::calculateTotalSales();
    }

    public function getCustomersCount()
    {
        return $this->customers_count;
    }

    public function getCompleteOrdersCount()
    {
        return $this->complete_orders_count;
    }

    public function getProductsCount()
    {
        return $this->products_count;
    }

    public function getTotalSales()
    {
        return $this->total_sales;
    }

    public function getProductChartData()
    {
        return [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Published', 'Unpublished'],
                'datasets' => [
                    [
                        'data' => [
                            $this->published_products_count, 
                            $this->unpublished_products_count
                        ],
                        'backgroundColor' => ['#6EE7B7', '#FCD34D'],
                        'hoverOffset' => 4
                    ]
                ]
            ],
            'options' => $this->getChartOptions()
        ];
    }

    public function getOrderChartData()
    {
        return [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Preparing', 'Shipped', 'Delivery'],
                'datasets' => [
                    [
                        'data' => [1, 2, 3],
                        'backgroundColor' => ['#93C5FD', '#A5B4FC', '#FCD34D'],
                        'hoverOffset' => 4
                    ]
                ]
            ],
            'options' => $this->getChartOptions()
        ];
    }

    private function getChartOptions()
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'pointStyle' => 'circle',
                        'usePointStyle' => true
                    ]
                ]
            ]
        ];
    }
}