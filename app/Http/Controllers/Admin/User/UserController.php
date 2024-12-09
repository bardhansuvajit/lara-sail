<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index(): View
    {
        $data = \App\Models\User::paginate(10);
        return view('admin.user.index', [
            'data' => $data
        ]);
    }
}
