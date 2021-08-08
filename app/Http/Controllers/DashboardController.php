<?php

use App\Http\Controllers\Controller;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        return view('dashboard.dashboard');
    }
}
