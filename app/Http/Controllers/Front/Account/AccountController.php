<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Display the account index page.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('front.account.index');
    }
}
