<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesMarketingController extends Controller
{
    public function index()
    {
        // Sample marketing analytics data
        $data = [
            'sales_summary' => [
                'total_sales' => 85000,
                'conversion_rate' => 15.8,
                'leads' => 2500,
                'marketing_cost' => 25000
            ],
            'sales_performance' => [
                ['period' => 'Jan', 'sales' => 25000, 'target' => 30000],
                ['period' => 'Feb', 'sales' => 28000, 'target' => 30000],
                ['period' => 'Mar', 'sales' => 32000, 'target' => 30000]
            ],
            'campaign_performance' => [
                ['campaign' => 'Email Marketing', 'leads' => 850, 'conversions' => 127],
                ['campaign' => 'Social Media', 'leads' => 720, 'conversions' => 98],
                ['campaign' => 'Content Marketing', 'leads' => 560, 'conversions' => 84],
                ['campaign' => 'PPC Ads', 'leads' => 370, 'conversions' => 63]
            ],
            'monthly_leads' => [
                ['month' => 'Jan', 'leads' => 720],
                ['month' => 'Feb', 'leads' => 840],
                ['month' => 'Mar', 'leads' => 940]
            ],
            'channel_distribution' => [
                ['channel' => 'Organic Search', 'percentage' => 35],
                ['channel' => 'Paid Search', 'percentage' => 25],
                ['channel' => 'Social Media', 'percentage' => 20],
                ['channel' => 'Direct', 'percentage' => 12],
                ['channel' => 'Referral', 'percentage' => 8]
            ],
            'conversion_metrics' => [
                'website_visitors' => 45000,
                'lead_conversion_rate' => 5.5,
                'customer_conversion_rate' => 15.8,
                'average_time_to_convert' => 12
            ],
            'lead_sources' => [
                ['source' => 'Search Engine', 'count' => 850],
                ['source' => 'Social Media', 'count' => 720],
                ['source' => 'Email Marketing', 'count' => 560],
                ['source' => 'Direct Traffic', 'count' => 370]
            ],
            'marketing_roi' => [
                ['month' => 'Jan', 'cost' => 8000, 'return' => 25000, 'roi' => 212.5],
                ['month' => 'Feb', 'cost' => 8500, 'return' => 28000, 'roi' => 229.4],
                ['month' => 'Mar', 'cost' => 8500, 'return' => 32000, 'roi' => 276.5]
            ]
        ];

        return view('sales-marketing', compact('data'));
    }
}