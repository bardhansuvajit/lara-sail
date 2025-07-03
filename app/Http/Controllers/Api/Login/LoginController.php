<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\UserInterface;

class LoginController extends Controller
{
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function check(Request $request) {
        // dd($request->phone);

        // check if phone is not empty & 10 digits
        $validator = Validator::make($request->all(), [
            'country' => 'required|string|in:IN',
            'phone' => 'required|digits:10'
        ], [
            'phone.required' => 'Phone number is required',
            'phone.digits' => 'Phone number must be exactly 10 digits'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // check if phone number exists in users table
        $userExistCheck = $this->userRepository->getByCountryPrimaryPhone($request->country, $request->phone);

        return $userExistCheck;
    }

    public function login(Request $request) {
        // dd($request->phone);

        // check if phone is not empty & 10 digits
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            'password' => 'required|string'
        ], [
            'phone.required' => 'Phone number is required',
            'phone.digits' => 'Phone number must be exactly 10 digits'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // check if phone number exists in users table
        $userExistCheck = $this->userRepository->getByCountryPrimaryPhone($request->phone, $request->password);

        return $userExistCheck;

        // return response()->json([
        //     'code' => 200,
        //     'country' => $request->country,
        //     'phone' => $request->phone
        // ]);
    }

}
