<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;

class AuthenticatedSessionController extends Controller
{
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;

    public function __construct(CountryInterface $countryRepository, UserInterface $userRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // dd('hh');
        // active countries
        $countries_filters = [
            'status' => 1,
        ];
        $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');

        // trying for login
        if (!empty($request->phone_country_code) && !empty($request->phone_no)) {
            // dynamic phone number digits based on country
            $phoneNumberDigits = 10;

            // phone number country code fetch
            if (!empty($request->phone_country_code)) {
                $countryData = $this->countryRepository->getByShortName($request->phone_country_code);
            }
            if($countryData['code'] == 200) $phoneNumberDigits = $countryData['data']->phone_no_digits;

            $request->validate([
                'phone_country_code' => 'required|string|min:1|max:5',
                'phone_no' => 'required|integer|digits:'.$phoneNumberDigits,
            ]);

            // check if user exists
            $userData = $this->userRepository->getByCountryPrimaryPhone($countryData['data']->id, $request->phone_no);
            if ($userData['code'] == 200) {
                return view('front.auth.login', [
                    'activeCountries' => $activeCountries['data'],
                    'type' => 'login',
                    'focus' => 'password'
                ]);
            } else {
                return view('front.auth.login', [
                    'activeCountries' => $activeCountries['data'],
                    'type' => 'register',
                    'focus' => 'first_name'
                ]);
            }
        }

        return view('front.auth.login', [
            'activeCountries' => $activeCountries['data'],
            'focus' => 'phone_no'
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        dd('here');
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
