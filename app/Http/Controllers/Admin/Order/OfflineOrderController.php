<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\ProductListingInterface;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class OfflineOrderController extends Controller
{
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private ProductListingInterface $productListingRepository;

    public function __construct(
        CountryInterface $countryRepository, 
        UserInterface $userRepository, 
        ProductListingInterface $productListingRepository
    )
    {
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->productListingRepository = $productListingRepository;
    }

    public function create(Request $request): View
    {
        // dd($request->all());

        if (request()->input('country') && request()->input('phone-no')) {
            $country = request()->input('country');
            $phoneNo = request()->input('phone-no');

            $userData = $this->userRepository->exists([
                'country_code' => $country,
                'primary_phone_no' => $phoneNo
            ]);

            // when USER NOT FOUND
            if ($userData['code'] == 404) {
                return redirect()->route('admin.user.create', [
                    'country' => $country,
                    'phone-no' => $phoneNo,
                    'redirect-to' => 'offline-order'
                ]);
            }

            // dd($userData);

            // when USER FOUND
            return view('admin.order.create', [
                'userId' => $userData['data'][0]->id,
                'userFirstName' => $userData['data'][0]->first_name,
                'userLastName' => $userData['data'][0]->last_name,
                'userEmail' => $userData['data'][0]->email,
                'userPhoneNo' => $userData['data'][0]->primary_phone_no,
                'userCountry' => $userData['data'][0]->country->name,
                'userFlag' => $userData['data'][0]->country->flag,
            ]);

            // dd('here>>', $userData);
        } else {
            return view('admin.order.create');
        }
    }

    public function searchUser(Request $request): View|RedirectResponse
    {
        // dd($request->all());

        $phoneNumberDigits = 10;
        // phone number country code fetch
        if (!empty($request->country_code) && !empty($request->primary_phone_no)) {
            $countryData = $this->countryRepository->getByShortName($request->country_code);
            if($countryData['code'] == 200) $phoneNumberDigits = $countryData['data']->phone_no_digits;
        }

        $request->validate([
            'country_code' => 'required|string|max:2|exists:countries,code',
            'primary_phone_no' => 'required|integer|digits:'.$phoneNumberDigits,
        ]);

        $userData = $this->userRepository->exists([
            'country_code' => $request->country_code,
            'primary_phone_no' => $request->primary_phone_no
        ]);

        // when USER NOT FOUND
        if ($userData['code'] == 404) {
            return redirect()->route('admin.user.create', [
                'country' => $request->country_code,
                'phone-no' => $request->primary_phone_no,
                'redirect-to' => 'offline-order'
            ]);
        }

        // Product data
        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,level',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1'
        ]);
        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', 1),
        ];
        $productsResp = $this->productListingRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        // when USER FOUND
        return view('admin.order.create', [
            'userId' => $userData['data'][0]->id,
            'userFirstName' => $userData['data'][0]->first_name,
            'userLastName' => $userData['data'][0]->last_name,
            'userEmail' => $userData['data'][0]->email,
            'userPhoneNo' => $userData['data'][0]->primary_phone_no,
            'userCountry' => $userData['data'][0]->country->name,
            'userFlag' => $userData['data'][0]->country->flag,
            'products' => $productsResp['data'],
        ]);
    }

}
