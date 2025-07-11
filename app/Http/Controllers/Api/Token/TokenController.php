<?php

namespace App\Http\Controllers\Api\Token;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Interfaces\UserLoginHistoryInterface;

class TokenController
{
    private UserLoginHistoryInterface $userLoginHistoryRepository;

    public function __construct(UserLoginHistoryInterface $userLoginHistoryRepository)
    {
        $this->userLoginHistoryRepository = $userLoginHistoryRepository;
    }

    public function validate(Request $request, Int $userId)
    {
        // dd($request->phone);

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        // check if token is valid
        $tokenCheck = $this->userLoginHistoryRepository->validateToken($token, $userId);

        return $tokenCheck;

        // return response()->json([
        //     'code' => 200,
        //     'token' => $token,
        // ]);

        // $validator = Validator::make($request->all(), [
        //     'token' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'code' => 422,
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // // check if phone number exists in users table
        // $userExistCheck = $this->userLoginHistoryRepository->getByCountryPrimaryPhone($request->country, $request->phone);

        // return $userExistCheck;
    }

}
