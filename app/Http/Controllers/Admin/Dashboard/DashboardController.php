<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController
{
    /**
     * Display the dashboard view.
     */
    public function index(): View
    {
        return view('admin.dashboard.index');
    }
}
