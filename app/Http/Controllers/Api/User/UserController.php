<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Interfaces\UserInterface;
use App\Interfaces\PasswordInterface;

class UserController
{
    private UserInterface $userRepository;
    private PasswordInterface $passwordRepository;

    public function __construct(UserInterface $userRepository, PasswordInterface $passwordRepository)
    {
        $this->userRepository = $userRepository;
        $this->passwordRepository = $passwordRepository;
    }

    public function index(Request $request)
    {
        $user_id = $request->user_id;

        $userDetailResp = $this->userRepository->getById($user_id);

        if ($userDetailResp['code'] == 200) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Data found',
                'data' => $userDetailResp['data'],
            ]);
        } else {
            return $userUpdateResp;
        }
    }

    public function update(Request $request)
    {
        $user_id = $request->user_id;

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user_id),
            ],
            'phone' => [
                'required',
                'integer',
                'digits:10',
                Rule::unique('users', 'primary_phone_no')->ignore($user_id),
            ],
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|integer|between:1,4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validation failed',
                'error' => $validator->errors()->first()
            ], 422);
        }

        $userUpdateResp = $this->userRepository->update([
            'id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country_code' => 'IN',
            'primary_phone_no' => $request->phone,
            'date_of_birth' => $request->date_of_birth ?? null,
            'gender_id' => $request->gender ?? 4,
            'alt_phone_no' => $request->alt_phone_no ?? null,
        ]);

        if ($userUpdateResp['code'] == 200) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $userUpdateResp['data'],
            ]);
        } else {
            return $userUpdateResp;
        }
    }

    public function passwordUpdate(Request $request)
    {
        $user_id = $request->user_id;

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:5|max:20',
            'new_password' => 'required|string|min:5|max:20',
            'confirm_password' => 'required|string|min:5|max:20|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validation failed',
                'error' => $validator->errors()->first()
            ], 422);
        }

        $passwUpdateResp = $this->passwordRepository->update(
            array_merge(
                $request->only('current_password', 'new_password'), [
                    'guard' => 'Api',
                    'user_id' => $user_id
                ]
            )
        );

        if ($passwUpdateResp['code'] == 200) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Password has been changed',
            ]);
        } else {
            return $passwUpdateResp;
        }

        /*
        $userUpdateResp = $this->userRepository->update([
            'id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country_code' => 'IN',
            'primary_phone_no' => $request->phone,
            'date_of_birth' => $request->date_of_birth ?? null,
            'gender_id' => $request->gender ?? 4,
            'alt_phone_no' => $request->alt_phone_no ?? null,
        ]);

        if ($userUpdateResp['code'] == 200) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $userUpdateResp['data'],
            ]);
        } else {
            return $userUpdateResp;
        }
        */
    }

}
