<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;

class CountryController extends Controller
{
    private CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function detail(String $code) {
        // dd($request->all());
        $resp = $this->countryRepository->getByShortName($code);
        return $resp;
    }

    public function update(String $code) {
        // dd($request->all());
        $resp = $this->countryRepository->getByShortName($code);
        // dd($resp);

        if ($resp['code'] == 200) {
            $data = $resp['data'];
            // COOKIE - Currency & Country
            setcookie('currency', urlencode(json_encode([
                    "country" => $data->code,
                    "countryFullName" => $data->name,
                    "currency" => $data->currency_code,
                    "icon" => $data->currency_symbol,
                    "phoneCode" => $data->phone_code,
                    "phoneNoDigits" => $data->phone_no_digits,
                    "postalCodeDigits" => ($data->code == "IN") ? 10 : 5,
                    "flagSvg" => $data->flag
                ])),
                time() + (86400 * 365), // expire in 30 days
                "/" // important: ensure it's global to overwrite
            );


            // dd(COUNTRY);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Country updated',
                'data' => $data,
            ];
        } else {
            return $resp;
        }

    }

}
