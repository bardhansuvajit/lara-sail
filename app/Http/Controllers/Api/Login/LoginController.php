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

    public function __construct(
        UserInterface $userRepository,
        UserLoginHistoryInterface $userLoginHistoryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userLoginHistoryRepository = $userLoginHistoryRepository;
    }

    /**
     * Check if user exists by phone and country.
     */
    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required|string|in:IN',
            'phone' => 'required|digits:10',
        ], [
            'phone.required' => 'Phone number is required',
            'phone.digits' => 'Phone number must be exactly 10 digits',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        return $this->userRepository->getByCountryPrimaryPhone($request->country, $request->phone);
    }

    /**
     * Login user with phone and password.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $userLoginCheck = $this->userRepository->loginCheck(
            $request->get('country'),
            $request->phone,
            $request->password
        );

        if ($userLoginCheck['code'] !== 200) {
            return $userLoginCheck;
        }

        $deviceHeaders = $this->extractDeviceHeaders($request);

        $token = Str::random(64);
        $hashedToken = Hash::make($token);

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
            'last_activity_at' => now(),
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Login successful',
            'data' => $userLoginCheck['data'],
            'token' => $token,
        ]);
    }

    /**
     * Register a new user.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            'name' => 'required|string|min:5|max:100',
            'email' => 'nullable|string|email|min:5|max:100',
            'password' => 'required|string|min:5|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $fullName = trim(preg_replace('/\s+/', ' ', $request->name));
        $nameParts = explode(' ', $fullName);

        $firstName = ucfirst(array_shift($nameParts));
        $lastName = count($nameParts) ? ucfirst(implode(' ', $nameParts)) : '';

        $userRegistrationCheck = $this->userRepository->store([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->filled('email') ? trim($request->email) : null,
            'country_code' => $request->get('countryCode', 'IN'),
            'primary_phone_no' => trim($request->phone),
            'gender_id' => $request->get('genderId', 4),
            'password' => $request->password,
        ]);

        if ($userRegistrationCheck['code'] !== 200) {
            return $userRegistrationCheck;
        }

        $deviceHeaders = $this->extractDeviceHeaders($request);

        $token = Str::random(64);
        $hashedToken = Hash::make($token);

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
            'last_activity_at' => now(),
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Registration successful',
            'data' => $userRegistrationCheck['data'],
            'token' => $token,
        ]);
    }

    /**
     * Logout the user by deactivating the token.
     */
    public function logout(Request $request, int $userId)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $tokenValidation = $this->userLoginHistoryRepository->validateToken($token, $userId);

        if ($tokenValidation['code'] === 200) {
            $this->userLoginHistoryRepository->update([
                'id' => $tokenValidation['data']->id,
                'is_active' => 0,
                'last_activity_at' => now(),
                'expires_at' => now(),
                'logout_reason' => 'force logout by user',
            ]);
        }

        return $tokenValidation;
    }

    /**
     * Extract custom device headers.
     */
    private function extractDeviceHeaders(Request $request): array
    {
        return [
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
    }
}
