<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\ProfileInterface;
use App\Interfaces\CountryInterface;

class ProfileController
{
    private ProfileInterface $profileRepository;
    private CountryInterface $countryRepository;

    public function __construct(ProfileInterface $profileRepository, CountryInterface $countryRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $countries_filters = [
            'status' => 1,
        ];
        $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');
        return view('admin.profile.edit', [
            'activeCountries' => $activeCountries['data']
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // dd($request->all());

        // dynamic phone number digits based on country
        $phoneNumberDigits = $altPhoneNumberDigits = 10;
        $altPhoneFields = 'nullable';

        // phone number country code fetch
        if (!empty($request->phone_country_code)) {
            $countryData = $this->countryRepository->getByShortName($request->phone_country_code);
        } elseif (!empty(Auth::guard('admin')->user()->phone_country_code)) {
            $countryData = $this->countryRepository->getByShortName(Auth::guard('admin')->user()->phone_country_code);
        }
        if($countryData['code'] == 200) $phoneNumberDigits = $countryData['data']->phone_no_digits;

        // alternate phone number country code fetch
        if (!empty($request->alt_phone_country_code)) {
            $altPhoneFields = 'required';
            $countryData = $this->countryRepository->getByShortName($request->alt_phone_country_code);
        } elseif (!empty(Auth::guard('admin')->user()->alt_phone_country_code)) {
            $countryData = $this->countryRepository->getByShortName(Auth::guard('admin')->user()->alt_phone_country_code);
        }
        if($countryData['code'] == 200) $altPhoneNumberDigits = $countryData['data']->phone_no_digits;

        $request->validate([
            'profile_picture' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|email|min:2|max:80',
            'phone_country_code' => 'required|string|min:1|max:5',
            'phone_no' => 'required|integer|digits:'.$phoneNumberDigits,
            'username' => 'required|string|min:2|max:50',

            'alt_phone_country_code' => $altPhoneFields.'|string|min:1|max:5',
            'alt_phone_no' => $altPhoneFields.'|integer|digits:'.$altPhoneNumberDigits,
        ], [
            'profile_picture.max' => 'The profile picture field must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
        ]);

        $resp = $this->profileRepository->update(
            array_merge(
                $request->all(), [
                    'guard' => 'admin',
                    'user_id' => Auth::guard('admin')->user()->id
                ]
            )
        );

        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
