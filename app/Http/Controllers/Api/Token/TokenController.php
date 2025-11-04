<?php

namespace App\Http\Controllers\Api\Token;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Interfaces\UserInterface;
use App\Interfaces\UserLoginHistoryInterface;

class TokenController
{
    private UserLoginHistoryInterface $userLoginHistoryRepository;
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository, UserLoginHistoryInterface $userLoginHistoryRepository)
    {
        $this->userRepository = $userRepository;
        $this->userLoginHistoryRepository = $userLoginHistoryRepository;
    }

    public function validate(Request $request)
    {
        $user_id = $request->user_id;

        $userDetailResp = $this->userRepository->getById($user_id);

        if ($userDetailResp['code'] == 200) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Token Valid',
                'data' => $userDetailResp['data'],
            ]);
        } else {
            return $userUpdateResp;
        }
    }

    public function validateOld(Request $request, int $userId)
    {
        // dd($request->phone);

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        // check if token is valid
        $tokenCheck = $this->userLoginHistoryRepository->validateToken($token, $userId);
        return $tokenCheck;
    }

}
