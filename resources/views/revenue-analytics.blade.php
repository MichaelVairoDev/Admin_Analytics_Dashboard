@extends('adminlte::page')

@section('title', 'Revenue Analytics')

@section('content_header')
    <h1>Revenue Analytics</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>${{ number_format($data['revenue_summary']['total_revenue']) }}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>${{ number_format($data['revenue_summary']['monthly_revenue']) }}</h3>
                    <p>Monthly Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $data['revenue_summary']['revenue_growth'] }}%</h3>
                    <p>Revenue Growth</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>${{ number_format($data['revenue_summary']['average_order_value']) }}</h3>
                    <p>Average Order Value</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Revenue Trends</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueTrendsChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Methods</h3>
                </div>
                <div class="card-body">
                    <canvas id="paymentMethodsChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Revenue by Region</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueByRegionChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Subscription Metrics</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{ $data['subscription_metrics']['total_subscribers'] }}" data-min="0" data-max="1000" data-width="90" data-height="90" data-fgColor="#3c8dbc">
                            <div class="knob-label">Total Subscribers</div>
                        </div>
                        <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{ $data['subscription_metrics']['mrr'] }}" data-min="0" data-max="50000" data-width="90" data-height="90" data-fgColor="#00a65a">
                            <div class="knob-label">MRR</div>
                        </div>
                        <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{ $data['subscription_metrics']['churn_rate'] }}" data-min="0" data-max="10" data-width="90" data-height="90" data-fgColor="#f56954">
                            <div class="knob-label">Churn Rate</div>
                        </div>
                        <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{ $data['subscription_metrics']['lifetime_value'] }}" data-min="0" data-max="2000" data-width="90" data-height="90" data-fgColor="#00c0ef">
                            <div class="knob-label">Customer LTV</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    <script>
        $(function () {
            // Revenue Trends Chart
            var trendsCtx = document.getElementById('revenueTrendsChart').getContext('2d');
            new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($data['revenue_trends'], 'month')) !!},
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: {!! json_encode(array_column($data['revenue_trends'], 'revenue')) !!},
                        borderColor: '#3c8dbc',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Payment Methods Chart
            var methodsCtx = document.getElementById('paymentMethodsChart').getContext('2d');
            new Chart(methodsCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($data['payment_methods'], 'method')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($data['payment_methods'], 'amount')) !!},
                        backgroundColor: ['#00c0ef', '#00a65a', '#f39c12', '#f56954']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Revenue by Region Chart
            var regionCtx = document.getElementById('revenueByRegionChart').getContext('2d');
            new Chart(regionCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($data['revenue_by_region'], 'region')) !!},
                    datasets: [{
                        label: 'Revenue by Region',
                        data: {!! json_encode(array_column($data['revenue_by_region'], 'amount')) !!},
                        backgroundColor: '#3c8dbc'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Initialize Knob charts
            $('.knob').knob();
        });
    </script>
@stop