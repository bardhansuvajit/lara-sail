<?php

namespace App\Http\Controllers\Front\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\StateInterface;
use App\Interfaces\CartInterface;
use App\Interfaces\CartSettingInterface;
use App\Interfaces\PaymentMethodInterface;

class CheckoutController extends Controller
{
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private StateInterface $stateRepository;
    private CartInterface $cartRepository;
    private CartSettingInterface $cartSettingRepository;
    private PaymentMethodInterface $paymentMethodRepository;

    public function __construct(
        CountryInterface $countryRepository, 
        UserInterface $userRepository, 
        StateInterface $stateRepository, 
        CartInterface $cartRepository, 
        CartSettingInterface $cartSettingRepository,
        PaymentMethodInterface $paymentMethodRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->stateRepository = $stateRepository;
        $this->cartRepository = $cartRepository;
        $this->cartSettingRepository = $cartSettingRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index(Request $request): View|RedirectResponse
    {
        $country = COUNTRY['country'];

        // Check if there are products in cart
        if (auth()->guard('web')->check()) {
            $cart = $this->cartRepository->exists([
                'user_id' => auth()->guard('web')->user()->id
            ]);

            // If NO ITEMS in Cart
            if ($cart['code'] == 404) {
                return redirect()->route('front.cart.index');
            }
        } else {
            if (isset($_COOKIE['device_id'])) {
                $deviceId = $_COOKIE['device_id'];
                $cart = $this->cartRepository->exists([
                    'device_id' => $deviceId,
                ]);

                // If NO ITEMS in Cart
                if ($cart['code'] == 404) {
                    return redirect()->route('front.cart.index');
                }
            } else {
                return redirect()->route('front.cart.index');
            }
        }

        // Check for MINIMUM ORDER VALUE
        $totalCartValue = $cart['data']->total;
        $cartSettingData = $this->cartSettingRepository->exists([
            'country' => $country
        ])['data'];

        if ($cartSettingData->min_order_value > $totalCartValue) {
            return redirect()->route('front.cart.index', ['minimum-cart-value-alert' => 'true']);
        }

        // When User is LOGGED IN
        if (auth()->guard('web')->check()) {
            $shippingAddresses = auth()->guard('web')->user()->shippingAddresses;
            // $billingAddresses = auth()->guard('web')->user()->billingAddresses;

            // $statesData = $this->stateRepository->list('', ['country_code' => COUNTRY['country']], 'all', 'name', 'asc');
            // $states = $statesData['data'];

            return view('front.checkout.index', [
                'user' => auth()->guard('web')->user(),
                // 'states' => $states,
                // 'shippingAddresses' => $shippingAddresses,
                'shippingAddressesCount' => count($shippingAddresses),
                // 'billingAddresses' => $billingAddresses,
                // 'billingAddressesCount' => count($billingAddresses),
            ]);
        }
        // When User is NOT LOGGED IN
        else {
            // When phone_no is SENT in URL
            if (!empty($_GET['phone_no'])) {
                $phoneNo = $_GET['phone_no'];

                $phoneNumberDigits = COUNTRY['phoneNoDigits'];
                $countryShortName = $country;
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
                        // 'countryId' => $countryId
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
