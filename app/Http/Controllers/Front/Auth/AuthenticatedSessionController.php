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

class AuthenticatedSessionController extends Controller
{
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private CartInterface $cartRepository;

    public function __construct(CountryInterface $countryRepository, UserInterface $userRepository, CartInterface $cartRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->cartRepository = $cartRepository;    
    }

    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // dd('hh');
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
                ]);
            }
            // IF USER NOT FOUND
            else {
                return view('front.auth.login', [
                    'focus' => 'first_name',
                    'buttonText' => 'Create Account',
                    'formType' => 'register',
                    // 'countryId' => $countryId
                ]);
            }
        }
        // When phone_no is NOT SENT in URL
        else {
            return view('front.auth.login', [
                'focus' => 'phone_no',
                'buttonText' => 'Continue',
                'formType' => 'default'
            ]);
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd('here');
        $request->authenticate();
        $request->session()->regenerate();

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
                    'user_id' => auth()->guard('web')->user()->id
                ]);
            }
        }

        if ($request->request_path == "checkout") {
            return redirect()->back()->with('success', 'Logged-in Successfully.');
        }
        return redirect()->intended(route('front.account.index', absolute: false));
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // redirect
        $referrer = request()->headers->get('referer');
        if (Str::contains($referrer, 'checkout')) {
            // The request came from a checkout page
            return redirect()->route('front.checkout.index');
        }

        return redirect('/');
    }
}
