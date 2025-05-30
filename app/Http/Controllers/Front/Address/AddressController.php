<?php

namespace App\Http\Controllers\Front\Address;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\AddressInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    private CountryInterface $countryRepository;
    private AddressInterface $addressRepository;

    public function __construct(CountryInterface $countryRepository, AddressInterface $addressRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->addressRepository = $addressRepository;
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $type = $request->input('type');
        session(['submitted_form_type' => $type]);

        $request->validate([
            'user_id' => 'required|integer|min:1|exists:users,id',
            'address_type' => 'required|string|in:shipping,billing',
            'is_default' => 'nullable|integer|in:1',

            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'address_line_1' => 'required|string|min:2|max:200',
            'address_line_2' => 'nullable|string|min:1|max:200',
            'city' => 'required|string|min:1|max:50',
            'state' => 'required|string|min:1|max:50',
            'postal_code' => 'required|string|digits:'.COUNTRY['postalCodeDigits'],
            'country_code' => 'required|string|max:2|exists:countries,short_name',
            'phone_no' => 'required|integer|digits:'.COUNTRY['phoneNoDigits'],
            'email' => 'nullable|email|min:2|max:80',
            'landmark' => 'nullable|string|min:1|max:200',
            'additional_notes' => 'nullable|string|min:1|max:50',
            'alt_phone_no' => 'nullable|integer|digits:'.COUNTRY['phoneNoDigits'],
        ]);

        $resp = $this->addressRepository->store([
            'user_id' => $request->user_id,
            'address_type' => $request->address_type,
            'is_default' => $request->is_default ? $request->is_default : (( count(auth()->guard('web')->user()->addresses) > 0 ) ? 0 : 1),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company' => $request->company ?? null,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country_code' => $request->country_code,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'landmark' => $request->landmark,
            'additional_notes' => $request->additional_notes,
            'alt_phone_no' => $request->alt_phone_no,
            // 'user_id' => auth()->guard('web')->user()->id
        ]);

        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function delete(Request $request, $id)
    {
        $resp = $this->addressRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

}
