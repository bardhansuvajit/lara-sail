<?php

namespace App\Http\Controllers\Front\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;

class CheckoutController extends Controller
{
    private CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index(): View
    {
        $countries_filters = [
            'status' => 1,
        ];
        $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');
        return view('front.checkout.index', [
            'activeCountries' => $activeCountries['data']
        ]);
    }
}
