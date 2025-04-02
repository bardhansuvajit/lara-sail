<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionCheckController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    // public function check(Request $request): RedirectResponse
    public function check(LoginRequest $request): RedirectResponse
    {
        // dd($request->all(), 'here2');
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('front.account.index', absolute: false));
        // return redirect(route('front.profile.index', absolute: false));
    }
}
