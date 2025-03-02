<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductAnalyticsController extends Controller
{
    public function index()
    {
        // Sample product analytics data
        $data = [
            'product_summary' => [
                'total_products' => 250,
                'active_products' => 180,
                'out_of_stock' => 15,
                'average_rating' => 4.2
            ],
            'category_performance' => [
                ['category' => 'Electronics', 'sales' => 45000, 'growth' => 12.5],
                ['category' => 'Clothing', 'sales' => 38000, 'growth' => 8.3],
                ['category' => 'Home & Garden', 'sales' => 32000, 'growth' => 15.7],
                ['category' => 'Books', 'sales' => 28000, 'growth' => 5.2]
            ],
            'inventory_status' => [
                ['status' => 'In Stock', 'count' => 150],
                ['status' => 'Low Stock', 'count' => 30],
                ['status' => 'Out of Stock', 'count' => 15],
                ['status' => 'On Order', 'count' => 55]
            ],
            'top_products' => [
                ['name' => 'Wireless Earbuds', 'sales' => 1200, 'revenue' => 28000],
                ['name' => 'Smart Watch', 'sales' => 850, 'revenue' => 25500],
                ['name' => 'Laptop Bag', 'sales' => 950, 'revenue' => 19000],
                ['name' => 'Phone Case', 'sales' => 1500, 'revenue' => 15000],
                ['name' => 'Power Bank', 'sales' => 750, 'revenue' => 13500]
            ],
            'product_ratings' => [
                ['rating' => 5, 'count' => 450],
                ['rating' => 4, 'count' => 320],
                ['rating' => 3, 'count' => 180],
                ['rating' => 2, 'count' => 90],
                ['rating' => 1, 'count' => 60]
            ]
        ];

        return view('product-analytics', compact('data'));
    }
}