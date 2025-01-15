<?php

namespace App\Http\Controllers\Admin\Password;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\PasswordInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PasswordController
{
    private PasswordInterface $passwordRepository;

    public function __construct(PasswordInterface $passwordRepository)
    {
        $this->passwordRepository = $passwordRepository;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        return view('admin.password.edit');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:2|max:15',
            'new_password' => 'required|string|min:2|max:15',
            'confirm_password' => 'required|string|min:2|max:15|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $resp = $this->passwordRepository->update(
            array_merge(
                $request->only('current_password', 'new_password'), [
                    'guard' => 'Admin',
                    'user_id' => Auth::guard('admin')->user()->id
                ]
            )
        );

        if ($resp['code'] == 401) {
            $validator->getMessageBag()->add('current_password', $resp['message']);

            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return redirect()->route('admin.profile.password.edit')->with($resp['status'], $resp['message']);
        }
    }
}
