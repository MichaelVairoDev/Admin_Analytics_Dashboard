@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Analytics Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($data['total_users']) }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($data['active_users']) }}</h3>
                    <p>Active Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>${{ number_format($data['total_revenue']) }}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $data['monthly_growth'] }}%</h3>
                    <p>Monthly Growth</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daily Active Users</h3>
                </div>
                <div class="card-body">
                    <canvas id="dailyActiveUsersChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Revenue by Category</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueByCategoryChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Performing Products</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Sales</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['top_performing_products'] as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['sales'] }}</td>
                                    <td>
                                        @php
                                            $percentage = ($product['sales'] / max(array_column($data['top_performing_products'], 'sales'))) * 100;
                                        @endphp
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Daily Active Users Chart
        new Chart(document.getElementById('dailyActiveUsersChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($data['daily_active_users'], 'date')) !!},
                datasets: [{
                    label: 'Active Users',
                    data: {!! json_encode(array_column($data['daily_active_users'], 'users')) !!},
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Revenue by Category Chart
        new Chart(document.getElementById('revenueByCategoryChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_column($data['revenue_by_category'], 'category')) !!},
                datasets: [{
                    data: {!! json_encode(array_column($data['revenue_by_category'], 'amount')) !!},
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@stop
