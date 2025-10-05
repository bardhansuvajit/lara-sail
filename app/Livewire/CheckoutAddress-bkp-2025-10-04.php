<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\StateInterface;
use App\Interfaces\AddressInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Front\Address\StoreAddressRequest;

class CheckoutAddress extends Component
{
    public $user;
    public Collection $states;
    public Collection $shippingAddresses;
    public Collection $billingAddresses;
    public int $shippingAddressesCount = 0;
    public int $billingAddressesCount = 0;
    public string $type = 'shipping';

    // Form properties
    public $first_name, $last_name, $phone_no, $email;
    public $address_line_1, $address_line_2, $postal_code, $city, $state;
    public $user_id, $address_type, $country_code;
    public $landmark, $alt_phone_no, $additional_notes;
    public $is_default = 0;

    private StateInterface $stateRepository;
    private AddressInterface $addressRepository;

    public function boot(StateInterface $stateRepository, AddressInterface $addressRepository)
    {
        $this->stateRepository = $stateRepository;
        $this->addressRepository = $addressRepository;
    }

    public function mount()
    {
        $this->user = auth()->guard('web')->user();

        // prefill form fields from user
        $this->user_id      = $this->user->id ?? '';
        $this->first_name   = $this->user->first_name ?? '';
        $this->last_name    = $this->user->last_name ?? '';
        $this->phone_no     = $this->user->primary_phone_no ?? '';
        $this->email        = $this->user->email ?? '';
        $this->address_type = $this->type ?? 'shipping';
        $this->country_code = COUNTRY['country'] ?? 'IN';

        if ($this->user) {
            $this->getAddresses();
        }

        $this->getStates();
    }

    public function saveAddress()
    {
        // $this->validate();
        $data = $this->validate((new StoreAddressRequest())->rules());

        $resp = $this->addressRepository->store([
            'user_id' => $this->user->id,
            'address_type' => $this->type,
            // 'is_default' => $this->is_default ? 1 : ((count($this->user->addresses) > 0) ? 0 : 1),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'country_code' => COUNTRY['country'],
            'phone_no' => $this->phone_no,
            'email' => $this->email,
            'landmark' => $this->landmark,
            'additional_notes' => null,
            'alt_phone_no' => $this->alt_phone_no,
            'is_default' => $this->is_default,
        ]);

        if ($resp['code'] == 200) {
            $this->getAddresses();
            // $this->resetExcept(['user','states','shippingAddresses','billingAddresses','shippingAddressesCount','billingAddressesCount','type']);
            $this->resetFormFields();

            $this->dispatch('show-notification', 
                $resp['message'], ['type' => 'success']
            );
            return;
            // session()->flash('success', 'Address added successfully.');
        } else {
            $this->dispatch('show-notification', 
                $resp['message'], ['type' => 'warning']
            );
            return;
        }
    }

    public function resetFormFields()
    {
        $this->reset([
            'first_name', 'last_name', 'phone_no', 'email',
            'address_line_1', 'address_line_2', 'postal_code', 
            'city', 'state', 'landmark', 'alt_phone_no', 'is_default'
        ]);
        
        // Reset to user defaults
        $this->first_name = $this->user->first_name ?? '';
        $this->last_name = $this->user->last_name ?? '';
        $this->phone_no = $this->user->primary_phone_no ?? '';
        $this->email = $this->user->email ?? '';
        $this->is_default = 0;
    }

    public function getAddresses()
    {
        $this->shippingAddresses = $this->user->shippingAddresses ?? [];
        $this->billingAddresses = $this->user->billingAddresses ?? [];

        $this->shippingAddressesCount = count($this->shippingAddresses);
        $this->billingAddressesCount = count($this->billingAddresses);
    }

    public function getStates()
    {
        $statesData = $this->stateRepository->list('', ['country_code' => COUNTRY['country']], 'all', 'name', 'asc');
        $this->states = $statesData['data'] ?? [];
    }

    public function render()
    {
        return view('livewire.checkout-address');
    }
}
