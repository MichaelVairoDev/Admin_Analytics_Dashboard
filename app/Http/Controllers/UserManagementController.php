<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        // Sample user management data
        $data = [
            'new_users_today' => 25,
            'new_users_week' => 158,
            'new_users_month' => 450,
            'user_demographics' => [
                ['age_group' => '18-24', 'count' => 320],
                ['age_group' => '25-34', 'count' => 480],
                ['age_group' => '35-44', 'count' => 280],
                ['age_group' => '45-54', 'count' => 120],
                ['age_group' => '55+', 'count' => 50]
            ],
            'user_activity' => [
                ['month' => '2024-01', 'signups' => 380, 'active' => 350],
                ['month' => '2024-02', 'signups' => 420, 'active' => 390],
                ['month' => '2024-03', 'signups' => 450, 'active' => 410]
            ],
            'recent_users' => [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'joined' => '2024-03-15', 'status' => 'active'],
                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'joined' => '2024-03-14', 'status' => 'active'],
                ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike@example.com', 'joined' => '2024-03-13', 'status' => 'inactive'],
                ['id' => 4, 'name' => 'Sarah Wilson', 'email' => 'sarah@example.com', 'joined' => '2024-03-12', 'status' => 'active'],
                ['id' => 5, 'name' => 'Tom Brown', 'email' => 'tom@example.com', 'joined' => '2024-03-11', 'status' => 'active']
            ]
        ];

        return view('user-management', compact('data'));
    }
}