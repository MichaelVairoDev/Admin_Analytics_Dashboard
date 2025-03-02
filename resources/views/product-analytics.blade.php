@extends('adminlte::page')

@section('title', 'Product Analytics')

@section('content_header')
    <h1>Product Analytics</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($data['product_summary']['total_products']) }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($data['product_summary']['active_products']) }}</h3>
                    <p>Active Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($data['product_summary']['out_of_stock']) }}</h3>
                    <p>Out of Stock</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($data['product_summary']['average_rating'], 1) }}</h3>
                    <p>Average Rating</p>
                </div>
                <div class="icon">
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="categoryPerformanceChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Inventory Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="inventoryStatusChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Products</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Sales</th>
                                <th>Revenue</th>
                                <th>Performance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['top_products'] as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ number_format($product['sales']) }}</td>
                                    <td>${{ number_format($product['revenue']) }}</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            @php
                                                $maxRevenue = max(array_column($data['top_products'], 'revenue'));
                                                $percentage = ($product['revenue'] / $maxRevenue) * 100;
                                            @endphp
                                            <div class="progress-bar bg-primary" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Ratings Distribution</h3>
                </div>
                <div class="card-body">
                    <canvas id="ratingsChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(function () {
            // Category Performance Chart
            var categoryCtx = document.getElementById('categoryPerformanceChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($data['category_performance'], 'category')) !!},
                    datasets: [{
                        label: 'Sales',
                        data: {!! json_encode(array_column($data['category_performance'], 'sales')) !!},
                        backgroundColor: '#3c8dbc',
                        yAxisID: 'y'
                    }, {
                        label: 'Growth %',
                        data: {!! json_encode(array_column($data['category_performance'], 'growth')) !!},
                        type: 'line',
                        borderColor: '#f39c12',
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Sales ($)'
                            }
                        },
                        y1: {
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Growth (%)'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Inventory Status Chart
            var inventoryCtx = document.getElementById('inventoryStatusChart').getContext('2d');
            new Chart(inventoryCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($data['inventory_status'], 'status')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($data['inventory_status'], 'count')) !!},
                        backgroundColor: ['#00a65a', '#f39c12', '#f56954', '#00c0ef']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Ratings Distribution Chart
            var ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
            new Chart(ratingsCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($data['product_ratings'], 'rating')) !!},
                    datasets: [{
                        label: 'Number of Ratings',
                        data: {!! json_encode(array_column($data['product_ratings'], 'count')) !!},
                        backgroundColor: '#3c8dbc'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop