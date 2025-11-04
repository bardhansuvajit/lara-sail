<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Interfaces\UserInterface;
use App\Interfaces\UserLoginHistoryInterface;

class LoginController extends Controller
{
    private UserInterface $userRepository;
    private UserLoginHistoryInterface $userLoginHistoryRepository;

    public function __construct(UserInterface $userRepository, UserLoginHistoryInterface $userLoginHistoryRepository)
    {
        $this->userRepository = $userRepository;
        $this->userLoginHistoryRepository = $userLoginHistoryRepository;
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

        // check login with Country, Phone Number & Password
        $userLoginCheck = $this->userRepository->loginCheck(
            $request->country ?? 'IN', 
            $request->phone, 
            $request->password
        );

        if ($userLoginCheck['code'] == 200) {
            // Extract device headers
            $deviceHeaders = [
                'device_model' => $request->header('X-Device-Model'),
                'device_brand' => $request->header('X-Device-Brand'),
                'device_type' => $request->header('X-Device-Type'),
                'device_year' => $request->header('X-Device-Year'),
                'platform' => $request->header('X-Platform'),
                'os_version' => $request->header('X-OS-Version'),
                'os_name' => $request->header('X-OS-Name'),
                'os_build' => $request->header('X-OS-Build'),
                'app_version' => $request->header('X-App-Version'),
                'app_build' => $request->header('X-App-Build'),
                'app_name' => $request->header('X-App-Name'),
                'app_id' => $request->header('X-App-ID'),
                'ip_address' => $request->header('X-IP-Address'),
                'is_emulator' => $request->header('X-Is-Emulator') === 'true',
                'device_id' => $request->header('X-Device-ID'),
                'screen_density' => $request->header('X-Screen-Density'),
                'latitude' => $request->header('X-Latitude'),
                'longitude' => $request->header('X-Longitude'),
            ];

            // Generate token
            $token = Str::random(64);
            // $hashedToken = hash('sha256', $token);
            $hashedToken = Hash::make($token);

            // Store login history with device info
            $this->userLoginHistoryRepository->store([
                'user_id' => $userLoginCheck['data']->id,
                'token' => $hashedToken,
                'platform' => $deviceHeaders['platform'],
                'device_brand' => $deviceHeaders['device_brand'],
                'os_version' => $deviceHeaders['os_version'],
                'device_model' => $deviceHeaders['device_model'],
                'app_version' => $deviceHeaders['app_version'],
                'latitude' => $deviceHeaders['latitude'],
                'longitude' => $deviceHeaders['longitude'],
                'ip_address' => $deviceHeaders['ip_address'],
                'payload' => json_encode($deviceHeaders),
                'login_at' => now(),
                'last_activity_at' => now()
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Login successful',
                'data' => $userLoginCheck['data'],
                'token' => $token // Returning plain token
            ]);
        }

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

        // store data in users table
        $userRegistrationCheck = $this->userRepository->store([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $request->filled('email') ? trim($request->email) : null,
            'country_code' => $request->countryCode ?? 'IN',
            'primary_phone_no' => trim($request->phone),
            'gender_id' => $request->genderId ?? 4,
            'password' => $request->password,
        ]);

        if ($userRegistrationCheck['code'] == 200) {
            // Extract device headers
            $deviceHeaders = [
                'device_model' => $request->header('X-Device-Model'),
                'device_brand' => $request->header('X-Device-Brand'),
                'device_type' => $request->header('X-Device-Type'),
                'device_year' => $request->header('X-Device-Year'),
                'platform' => $request->header('X-Platform'),
                'os_version' => $request->header('X-OS-Version'),
                'os_name' => $request->header('X-OS-Name'),
                'os_build' => $request->header('X-OS-Build'),
                'app_version' => $request->header('X-App-Version'),
                'app_build' => $request->header('X-App-Build'),
                'app_name' => $request->header('X-App-Name'),
                'app_id' => $request->header('X-App-ID'),
                'ip_address' => $request->header('X-IP-Address'),
                'is_emulator' => $request->header('X-Is-Emulator') === 'true',
                'device_id' => $request->header('X-Device-ID'),
                'screen_density' => $request->header('X-Screen-Density'),
                'latitude' => $request->header('X-Latitude'),
                'longitude' => $request->header('X-Longitude'),
            ];

            // Generate token
            $token = Str::random(64);
            // $hashedToken = hash('sha256', $token);
            $hashedToken = Hash::make($token);

            // Store login history with device info
            $this->userLoginHistoryRepository->store([
                'user_id' => $userRegistrationCheck['data']->id,
                'token' => $hashedToken,
                'platform' => $deviceHeaders['platform'],
                'device_brand' => $deviceHeaders['device_brand'],
                'os_version' => $deviceHeaders['os_version'],
                'device_model' => $deviceHeaders['device_model'],
                'app_version' => $deviceHeaders['app_version'],
                'latitude' => $deviceHeaders['latitude'],
                'longitude' => $deviceHeaders['longitude'],
                'ip_address' => $deviceHeaders['ip_address'],
                'payload' => json_encode($deviceHeaders),
                'login_at' => now(),
                'last_activity_at' => now()
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Login successful',
                'data' => $userRegistrationCheck['data'],
                'token' => $token // Returning plain token
            ]);
        }

        return $userRegistrationCheck;
    }

    public function logout(Request $request, int $userId)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        // check if token is valid
        // $dataExists = $this->userLoginHistoryRepository->exists([
        //     'user_id' => $userId,
        //     'token' => $token
        // ]);

        $dataExists = $this->userLoginHistoryRepository->validateToken($token, $userId);

        if ($dataExists['code'] == 200) {
            // foreach($dataExists['data'] as $toUpdateData) {
                $this->userLoginHistoryRepository->update([
                    'id' => $dataExists['data']->id,
                    'is_active' => 0,
                    'last_activity_at' => now(),
                    'expires_at' => now(),
                    'logout_reason' => 'force logout by user',
                ]);
            // }
        }

        return $dataExists;
    }

}
