@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
    <h1>User Management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['new_users_today'] }}</h3>
                    <p>New Users Today</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['new_users_week'] }}</h3>
                    <p>New Users This Week</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $data['new_users_month'] }}</h3>
                    <p>New Users This Month</p>
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
                    <h3 class="card-title">User Demographics</h3>
                </div>
                <div class="card-body">
                    <canvas id="userDemographicsChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Activity</h3>
                </div>
                <div class="card-body">
                    <canvas id="userActivityChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Users</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['recent_users'] as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['joined'] }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user['status'] === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user['status']) }}
                                        </span>
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
        // User Demographics Chart
        new Chart(document.getElementById('userDemographicsChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_column($data['user_demographics'], 'age_group')) !!},
                datasets: [{
                    data: {!! json_encode(array_column($data['user_demographics'], 'count')) !!},
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // User Activity Chart
        new Chart(document.getElementById('userActivityChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($data['user_activity'], 'month')) !!},
                datasets: [{
                    label: 'New Signups',
                    data: {!! json_encode(array_column($data['user_activity'], 'signups')) !!},
                    borderColor: '#00a65a',
                    fill: false
                }, {
                    label: 'Active Users',
                    data: {!! json_encode(array_column($data['user_activity'], 'active')) !!},
                    borderColor: '#f39c12',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@stop