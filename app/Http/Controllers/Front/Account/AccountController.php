<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\ProfileInterface;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    private CountryInterface $countryRepository;
    private ProfileInterface $profileRepository;

    public function __construct(CountryInterface $countryRepository, ProfileInterface $profileRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->profileRepository = $profileRepository;
    }

    public function index(Request $request): View
    {
        return view('front.account.index', [
            'user' => auth()->guard('web')->user()
        ]);
    }

    public function edit(Request $request): View
    {
        $countries_filters = [
            'status' => 1,
        ];
        $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');
        return view('front.account.edit', [
            'user' => auth()->guard('web')->user(),
            'activeCountries' => $activeCountries['data']
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // dd($request->all());

        // dynamic phone number digits based on country
        $phoneNumberDigits = $altPhoneNumberDigits = 10;
        // $altPhoneFields = 'nullable';

        // phone number country code fetch
        if (!empty($request->phone_country_code)) {
            $countryData = $this->countryRepository->getByShortName($request->phone_country_code);
        } elseif (!empty(Auth::guard('web')->user()->phone_country_code)) {
            $countryData = $this->countryRepository->getByShortName(Auth::guard('web')->user()->phone_country_code);
        }
        if($countryData['code'] == 200) $phoneNumberDigits = $countryData['data']->phone_no_digits;

        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|email|min:2|max:80',
            'phone_country_code' => 'required|string|min:1|max:5',
            'phone_no' => 'required|integer|digits:'.$phoneNumberDigits,
            'alt_phone_no' => 'nullable|integer|digits:'.$phoneNumberDigits,
            'gender_id' => 'nullable|integer|in:1,2,3,4',
        ], [
            'phone_country_code.*' => 'The selected Country is invalid.',
            'alt_phone_no.*' => 'The Alternate Phone number field must be 10 digits.'
        ]);

        $resp = $this->profileRepository->update(
            array_merge(
                $request->all(), [
                    'guard' => 'web',
                    'user_id' => Auth::guard('web')->user()->id
                ]
            )
        );

        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function updateOptional(Request $request): RedirectResponse
    {
        // dd($request->all());

        $request->validate([
            'gender_id' => ['nullable', 'integer', 'in:1,2,3,4'],
            'date_of_birth' => [
                'nullable', 'date_format:Y-m-d'
            ],
        ]);

        $resp = $this->profileRepository->updateOptional(
            array_merge(
                $request->all(), [
                    'guard' => 'web',
                    'user_id' => Auth::guard('web')->user()->id
                ]
            )
        );

        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
