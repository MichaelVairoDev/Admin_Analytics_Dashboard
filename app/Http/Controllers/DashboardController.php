<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Sample analytics data
        $data = [
            'total_users' => 1250,
            'active_users' => 890,
            'total_revenue' => 52500,
            'monthly_growth' => 15.7,
            'daily_active_users' => [
                ['date' => '2024-01', 'users' => 750],
                ['date' => '2024-02', 'users' => 820],
                ['date' => '2024-03', 'users' => 890]
            ],
            'revenue_by_category' => [
                ['category' => 'Products', 'amount' => 25000],
                ['category' => 'Services', 'amount' => 18500],
                ['category' => 'Subscriptions', 'amount' => 9000]
            ],
            'top_performing_products' => [
                ['name' => 'Product A', 'sales' => 120],
                ['name' => 'Product B', 'sales' => 95],
                ['name' => 'Product C', 'sales' => 85],
                ['name' => 'Product D', 'sales' => 70],
                ['name' => 'Product E', 'sales' => 65]
            ]
        ];

        return view('dashboard', compact('data'));
    }
}