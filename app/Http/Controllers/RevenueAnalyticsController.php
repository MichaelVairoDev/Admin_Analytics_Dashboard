<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RevenueAnalyticsController extends Controller
{
    public function index()
    {
        // Sample revenue analytics data
        $data = [
            'revenue_summary' => [
                'total_revenue' => 125000,
                'monthly_revenue' => 52500,
                'revenue_growth' => 23.5,
                'average_order_value' => 175
            ],
            'revenue_trends' => [
                ['month' => 'Jan', 'revenue' => 42000],
                ['month' => 'Feb', 'revenue' => 45000],
                ['month' => 'Mar', 'revenue' => 52500]
            ],
            'payment_methods' => [
                ['method' => 'Credit Card', 'amount' => 65000],
                ['method' => 'PayPal', 'amount' => 35000],
                ['method' => 'Bank Transfer', 'amount' => 15000],
                ['method' => 'Crypto', 'amount' => 10000]
            ],
            'revenue_by_region' => [
                ['region' => 'North America', 'amount' => 55000],
                ['region' => 'Europe', 'amount' => 35000],
                ['region' => 'Asia', 'amount' => 25000],
                ['region' => 'Others', 'amount' => 10000]
            ],
            'subscription_metrics' => [
                'total_subscribers' => 850,
                'mrr' => 25500,
                'churn_rate' => 2.3,
                'lifetime_value' => 1250
            ]
        ];

        return view('revenue-analytics', compact('data'));
    }
}