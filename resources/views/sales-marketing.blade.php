@extends('adminlte::page')

@section('title', 'Sales & Marketing Analytics')

@section('content_header')
    <h1>Sales & Marketing Analytics</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>${{ number_format($data['sales_summary']['total_sales']) }}</h3>
                    <p>Total Sales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['sales_summary']['conversion_rate'] }}%</h3>
                    <p>Conversion Rate</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($data['sales_summary']['leads']) }}</h3>
                    <p>New Leads</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>${{ number_format($data['sales_summary']['marketing_cost']) }}</h3>
                    <p>Marketing Cost</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="salesPerformanceChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lead Sources</h3>
                </div>
                <div class="card-body">
                    <canvas id="leadSourcesChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Campaign Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="campaignPerformanceChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Marketing ROI</h3>
                </div>
                <div class="card-body">
                    <canvas id="marketingROIChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(function () {
            // Sales Performance Chart
            var salesCtx = document.getElementById('salesPerformanceChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($data['sales_performance'], 'period')) !!},
                    datasets: [{
                        label: 'Sales',
                        data: {!! json_encode(array_column($data['sales_performance'], 'sales')) !!},
                        borderColor: '#3c8dbc',
                        tension: 0.1,
                        fill: false,
                        yAxisID: 'y'
                    }, {
                        label: 'Targets',
                        data: {!! json_encode(array_column($data['sales_performance'], 'target')) !!},
                        borderColor: '#f39c12',
                        borderDash: [5, 5],
                        tension: 0.1,
                        fill: false,
                        yAxisID: 'y'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount ($)'
                            }
                        }
                    }
                }
            });

            // Lead Sources Chart
            var leadSourcesCtx = document.getElementById('leadSourcesChart').getContext('2d');
            new Chart(leadSourcesCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($data['lead_sources'], 'source')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($data['lead_sources'], 'count')) !!},
                        backgroundColor: ['#00c0ef', '#00a65a', '#f39c12', '#f56954', '#3c8dbc']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Campaign Performance Chart
            var campaignCtx = document.getElementById('campaignPerformanceChart').getContext('2d');
            new Chart(campaignCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($data['campaign_performance'], 'campaign')) !!},
                    datasets: [{
                        label: 'Leads',
                        data: {!! json_encode(array_column($data['campaign_performance'], 'leads')) !!},
                        backgroundColor: '#3c8dbc'
                    }, {
                        label: 'Conversions',
                        data: {!! json_encode(array_column($data['campaign_performance'], 'conversions')) !!},
                        backgroundColor: '#00a65a'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        }
                    }
                }
            });

            // Marketing ROI Chart
            var roiCtx = document.getElementById('marketingROIChart').getContext('2d');
            new Chart(roiCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($data['marketing_roi'], 'month')) !!},
                    datasets: [{
                        label: 'Return',
                        data: {!! json_encode(array_column($data['marketing_roi'], 'return')) !!},
                        borderColor: '#00a65a',
                        tension: 0.1,
                        fill: false,
                        yAxisID: 'y'
                    }, {
                        label: 'Cost',
                        data: {!! json_encode(array_column($data['marketing_roi'], 'cost')) !!},
                        borderColor: '#f56954',
                        tension: 0.1,
                        fill: false,
                        yAxisID: 'y'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount ($)'
                            }
                        }
                    }
                }
            });
        });
    </script>
@stop