<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\CartInterface;

use App\Services\UserLoginHistoryService;

class AuthenticatedSessionController extends Controller
{
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private CartInterface $cartRepository;
    private UserLoginHistoryService $userLoginHistoryService;

    public function __construct(
        CountryInterface $countryRepository, 
        UserInterface $userRepository, 
        CartInterface $cartRepository, 
        UserLoginHistoryService $userLoginHistoryService
    ) {
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->cartRepository = $cartRepository;
        $this->userLoginHistoryService = $userLoginHistoryService;
    }

    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // dd('hh');
        // dd($request->all());
        // When phone_no is SENT in URL
        if (!empty($_GET['phone_no'])) {
            $phoneNo = $_GET['phone_no'];

            $phoneNumberDigits = COUNTRY['phoneNoDigits'];
            $countryShortName = COUNTRY['country'];
            // $countryData = $this->countryRepository->getByShortName($countryShortName);
            // $countryId = $countryData['data']->id;
            // $phoneNumberDigits = $countryData['data']->phone_no_digits;

            $request->validate([
                'phone_no' => 'required|integer|digits:'.$phoneNumberDigits,
            ]);

            // CHECK IF USER EXISTS
            $userData = $this->userRepository->getByCountryPrimaryPhone($countryShortName, $phoneNo);

            // dd($userData);

            // IF USER FOUND
            if ($userData['code'] == 200) {
                return view('front.auth.login', [
                    'focus' => 'password',
                    'buttonText' => 'Continue',
                    'formType' => 'login',
                    'redirect' => $request->redirect ?? ''
                ]);
            }
            // IF USER NOT FOUND
            else {
                return view('front.auth.login', [
                    'focus' => 'first_name',
                    'buttonText' => 'Create Account',
                    'formType' => 'register',
                    'redirect' => $request->redirect ?? ''
                    // 'countryId' => $countryId
                ]);
            }
        }
        // When phone_no is NOT SENT in URL
        else {
            return view('front.auth.login', [
                'focus' => 'phone_no',
                'buttonText' => 'Continue',
                'formType' => 'default',
                'redirect' => $request->redirect ?? ''
            ]);
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd('here');
        // dd($request->all());

        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->guard('web')->user();

        // Record login history after successful authentication
        try {
            // for session-based auth, generate a token
            $sessionToken = session()->getId();
            
            $this->userLoginHistoryService->recordLogin($user, $sessionToken, [
                'device_brand' => $request->input('device_brand'),
                'device_model' => $request->input('device_model'),
                'app_version' => $request->input('app_version'),
                // Add any additional data from request
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the login flow
            \Log::error('Failed to record login history: ' . $e->getMessage());
        }

        // Update Cart data
        if (!empty($_COOKIE['device_id'])) {
            $deviceId = $_COOKIE['device_id'];
            $cartData = $this->cartRepository->exists([
                'device_id' => $deviceId
            ]);

            // If there are products in cart
            if ($cartData['code'] == 200) {
                $cartData = $cartData['data'];

                $cartResp = $this->cartRepository->update([
                    'id' => $cartData->id,
                    'user_id' => $user->id
                ]);
            }
        }

        if ($request->request_path == "checkout") {
            return redirect()->back()->with('success', 'Logged-in Successfully.');
        }

        if (isset($request->redirect)) {
            return redirect()->to($request->redirect)->with('success', 'Logged-in Successfully.');
        }

        return redirect()->intended(route('front.account.index', absolute: false));
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // dd($request->all());

        $user = auth()->guard('web')->user();

        // Record logout before actually logging out
        if ($user) {
            try {
                // Option 1: Logout current session only
                $sessionToken = session()->getId();
                $this->userLoginHistoryService->logoutSession($sessionToken, 'user');
                
                // OR Option 2: Logout from all devices
                // $this->userLoginHistoryService->logoutFromAllDevices($user, 'user');
            } catch (\Exception $e) {
                \Log::error('Failed to record logout history: ' . $e->getMessage());
            }
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect
        if ($request->redirect) {
            return redirect($request->redirect);
        }

        $referrer = request()->headers->get('referer');
        if (Str::contains($referrer, 'checkout')) {
            return redirect()->route('front.checkout.index');
        }

        return redirect('/');
    }
}
