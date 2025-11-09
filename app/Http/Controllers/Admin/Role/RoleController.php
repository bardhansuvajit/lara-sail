<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController
{
    /**
     * Display the dashboard view.
     */
    public function index(): View
    {
        return view('admin.dashboard.index');
    }
}
