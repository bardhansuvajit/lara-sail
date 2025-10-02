<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function edit(Request $request): View
    {
        return view('front.account.password.edit', [
            'user' => auth()->guard('web')->user(),
        ]);
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // dd($request->all());
        // dd($request->user());

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // dd($validated);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated');
        // return back()->with('status', 'password-updated');
    }
}
