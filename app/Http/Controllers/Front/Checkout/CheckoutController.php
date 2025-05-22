<?php

namespace App\Http\Controllers\Front\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\StateInterface;

class CheckoutController extends Controller
{
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private StateInterface $stateRepository;

    public function __construct(CountryInterface $countryRepository, UserInterface $userRepository, StateInterface $stateRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->stateRepository = $stateRepository;
    }

    public function index(Request $request): View
    {
        // When User is LOGGED IN
        if (auth()->guard('web')->check()) {
            $shippingAddresses = auth()->guard('web')->user()->shippingAddresses;
            $billingAddresses = auth()->guard('web')->user()->billingAddresses;

            $statesData = $this->stateRepository->list('', ['country_id' => 82], 'all', 'name', 'asc');
            $states = $statesData['data'];

            return view('front.checkout.index', [
                'user' => auth()->guard('web')->user(),
                'states' => $states,
                'shippingAddresses' => $shippingAddresses,
                'billingAddresses' => $billingAddresses
            ]);
        }
        // When User is NOT LOGGED IN
        else {

            // When phone_no is SENT in URL
            if (!empty($_GET['phone_no'])) {
                $phoneNo = $_GET['phone_no'];

                $phoneNumberDigits = 10;
                $countryShortName = COUNTRY['country'];
                $countryData = $this->countryRepository->getByShortName($countryShortName);
                $countryId = $countryData['data']->id;
                $phoneNumberDigits = $countryData['data']->phone_no_digits;

                $request->validate([
                    'phone_no' => 'required|integer|digits:'.$phoneNumberDigits,
                ]);

                // CHECK IF USER EXISTS
                $userData = $this->userRepository->getByCountryPrimaryPhone($countryId, $phoneNo);

                // dd($userData);

                // IF USER FOUND
                if ($userData['code'] == 200) {
                    return view('front.checkout.index', [
                        'focus' => 'password',
                        'buttonText' => 'Continue',
                        'formType' => 'login',
                    ]);
                }
                // IF USER NOT FOUND
                else {
                    return view('front.checkout.index', [
                        'focus' => 'first_name',
                        'buttonText' => 'Create Account',
                        'formType' => 'register',
                        'countryId' => $countryId
                    ]);
                }

            }
            // When phone_no is NOT SENT in URL
            else {
                return view('front.checkout.index', [
                    'focus' => 'phone_no',
                    'buttonText' => 'Proceed',
                    'formType' => 'default'
                ]);
            }
        }
    }
}
