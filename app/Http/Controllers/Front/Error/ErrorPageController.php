<?php

namespace App\Http\Controllers\Front\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ErrorPageController extends Controller
{
    public function err404(Request $request)
    {
        return view('front.error.404');
    }

}
