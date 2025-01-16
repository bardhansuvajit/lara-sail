<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\ProfileInterface;

class ProfileController
{
    private ProfileInterface $profileRepository;

    public function __construct(ProfileInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        return view('admin.profile.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        dd($request->all());

        

        $request->validate([
            'profile_picture' => 'nullable|image|max:2000|mimes:jpg,jpeg,png,webp',
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|email|min:2|max:80',
            'phone_country_code' => 'nullable|string|min:1|max:5',
            'phone_no' => 'required|integer',
            'username' => 'required|string|min:2|max:50',
        ], [
            'profile_picture.max' => 'The profile picture may not be greater than 2 MB.',
        ]);

        $resp = $this->profileRepository->update(
            array_merge(
                $request->all(), [
                    'guard' => 'Admin',
                    'user_id' => Auth::guard('admin')->user()->id
                ]
            )
        );

        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
