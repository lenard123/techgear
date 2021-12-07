<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = new DashboardService;
        return view('admin.dashboard.index', [
            'dashboard' => $dashboard
        ]);
    }
}
