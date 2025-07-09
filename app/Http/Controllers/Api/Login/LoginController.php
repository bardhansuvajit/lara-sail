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

    // Check if Phone number exists in `uers` table
    public function check(Request $request)
    {
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

    // LOGIN with `Phone number` & `Password`
    public function login(Request $request)
    {
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
        $userLoginCheck = $this->userRepository->loginCheck($request->country, $request->phone, $request->password);

        return $userLoginCheck;
    }

    // REGISTER
    public function store(Request $request)
    {
        // dd($request->phone);

        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            'name' => 'required|string|min:5|max:100',
            'email' => 'nullable|string|email|min:5|max:100',
            'password' => 'required|string|min:5|max:50'
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

        // Sanitize and split name
        $fullName = trim(preg_replace('/\s+/', ' ', $request->name)); // remove extra spaces
        $nameParts = explode(' ', $fullName);

        // dd($nameParts);

        $first_name = ucfirst(array_shift($nameParts)); // First word
        $last_name = count($nameParts) > 0 ? ucfirst(implode(' ', $nameParts)) : ''; 

        // check if phone number exists in users table
        $userLoginCheck = $this->userRepository->store([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $request->filled('email') ? trim($request->email) : null,
            'country_code' => $request->countryCode ?? 'IN',
            'primary_phone_no' => trim($request->phone),
            'gender_id' => $request->genderId ?? 4,
            'password' => $request->password,
        ]);

        return $userLoginCheck;
    }

}
