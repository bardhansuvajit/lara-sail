<?php

namespace App\Http\Controllers\Front\Address;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;
use App\Interfaces\AddressInterface;
use App\Interfaces\StateInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    private CountryInterface $countryRepository;
    private AddressInterface $addressRepository;

    public function __construct(
        CountryInterface $countryRepository, 
        AddressInterface $addressRepository,
        StateInterface $stateRepository
    )
    {
        $this->countryRepository = $countryRepository;
        $this->addressRepository = $addressRepository;
        $this->stateRepository = $stateRepository;
    }

    public function index(): View
    {
        $userId = auth()->guard('web')->user()->id;
        $addresses = $this->addressRepository->exists([
            'user_id' => $userId
        ]);

        // $statesData = $this->stateRepository->list('', ['country_code' => COUNTRY['country']], 'all', 'name', 'asc');
        // $states = $statesData['data'];

        return view('front.account.address.index', [
            'user' => auth()->guard('web')->user(),
            'addresses' => $addresses['data'],
            // 'states' => $states
        ]);
    }

    public function create(): View
    {
        $userId = auth()->guard('web')->user()->id;
        $addresses = $this->addressRepository->exists([
            'user_id' => $userId
        ]);

        $statesData = $this->stateRepository->list('', ['country_code' => COUNTRY['country']], 'all', 'name', 'asc');
        $states = $statesData['data'];

        return view('front.account.address.create', [
            'user' => auth()->guard('web')->user(),
            'addresses' => $addresses['data'],
            'states' => $states
        ]);
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
            'country_code' => 'required|string|max:2|exists:countries,code',
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
        $userId = auth()->guard('web')->user()->id;
        $resp = $this->addressRepository->deleteLoggedInUserAddress($id, $userId);

        if ($resp['code'] == 200) {
            return redirect()->back()->with($resp['status'], 'Address Removed');
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }
    }

    public function default(Request $request, $id)
    {
        $userId = auth()->guard('web')->user()->id;
        $resp = $this->addressRepository->updateDefaultAddress($id, $userId);

        if ($resp['code'] == 200) {
            return redirect()->back()->with($resp['status'], 'Default Address updated');
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $previousUrl = url()->previous();

        $userId = auth()->guard('web')->user()->id;
        $address = $this->addressRepository->exists([
            'id' => $id,
            'user_id' => $userId
        ]);

        if ($address['code'] == 200) {
            $statesData = $this->stateRepository->list('', ['country_code' => COUNTRY['country']], 'all', 'name', 'asc');
            $states = $statesData['data'];

            return view('front.account.address.edit', [
                'user' => auth()->guard('web')->user(),
                'address' => $address['data'][0],
                'states' => $states,
                'previousUrl' => $previousUrl,
            ]);
        } else {
            // dd($address);
            // return redirect()->back()->with($address['status'], $address['message']);
            return redirect()->to($previousUrl);
        }        
    }

    public function update(Request $request): RedirectResponse
    {
        // dd($request->all());

        $type = $request->input('type');
        session(['submitted_form_type' => $type]);

        $request->validate([
            'id' => 'required|integer|min:1',
            'previous_url' => 'required',
            'address_type' => 'required|string|in:shipping,billing',
            'is_default' => 'nullable|integer|in:1',

            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'address_line_1' => 'required|string|min:2|max:200',
            'address_line_2' => 'nullable|string|min:1|max:200',
            'city' => 'required|string|min:1|max:50',
            'state' => 'required|string|min:1|max:50',
            'postal_code' => 'required|string|digits:'.COUNTRY['postalCodeDigits'],
            'country_code' => 'required|string|max:2|exists:countries,code',
            'phone_no' => 'required|integer|digits:'.COUNTRY['phoneNoDigits'],
            'email' => 'nullable|email|min:2|max:80',
            'landmark' => 'nullable|string|min:1|max:200',
            'additional_notes' => 'nullable|string|min:1|max:50',
            'alt_phone_no' => 'nullable|integer|digits:'.COUNTRY['phoneNoDigits'],
        ]);

        $userId = auth()->guard('web')->user()->id;
        $address = $this->addressRepository->exists([
            'id' => $request->id,
            'user_id' => $userId
        ]);

        if ($address['code'] == 200) {
            $resp = $this->addressRepository->update([
                'id' => $request->id,
                'is_default' => $request->is_default,
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
                'user_id' => $userId
            ]);

            return redirect()->to($request->previous_url)->with($resp['status'], $resp['message']);
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }  
    }

}
