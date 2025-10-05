<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\StateInterface;
use App\Interfaces\AddressInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Front\Address\StoreAddressRequest;

class CheckoutAddress extends Component
{
    public $user;

    /** Collections - can be arrays too if repository returns arrays */
    public Collection|array $states = [];
    public Collection|array $shippingAddresses = [];
    public Collection|array $billingAddresses = [];

    public int $shippingAddressesCount = 0;
    public int $billingAddressesCount = 0;

    // Which address type the form is currently adding/editing
    public string $address_type = 'shipping';

    // Form properties (shared for both shipping & billing)
    public $first_name;
    public $last_name;
    public $phone_no;
    public $email;
    public $address_line_1;
    public $address_line_2;
    public $postal_code;
    public $city;
    public $state;
    public $user_id;
    public $country_code;
    public $landmark;
    public $alt_phone_no;
    public $additional_notes;
    public $is_default = 1;

    // Alpine/Livewire controlled visibility of the address-create form
    public bool $showAddressForm = false;

    // Edit mode properties
    public ?int $editingAddressId = null;
    public bool $isEditing = false;

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
        $this->country_code = defined('COUNTRY') && is_array(COUNTRY) ? (COUNTRY['country'] ?? 'IN') : 'IN';

        if ($this->user) {
            $this->getAddresses();
        }

        $this->getStates();
    }

    /**
     * Open address add form for a given type (shipping|billing)
     * This method is called from the blade via wire:click.
     */
    public function openAddressForm(string $type = 'shipping')
    {
        $this->address_type = in_array($type, ['shipping', 'billing']) ? $type : 'shipping';
        $this->showAddressForm = true;
        $this->isEditing = false;
        $this->editingAddressId = null;

        // Prefill (again) so fields are consistent with auth user
        $this->first_name = $this->user->first_name ?? '';
        $this->last_name = $this->user->last_name ?? '';
        $this->phone_no = $this->user->primary_phone_no ?? '';
        $this->email = $this->user->email ?? '';
        $this->is_default = 1;

        // Reset other fields
        $this->reset([
            'address_line_1', 'address_line_2', 'postal_code',
            'city', 'state', 'landmark', 'alt_phone_no', 'additional_notes'
        ]);
    }

    /**
     * Open address edit form
     */
    public function editAddress($addressId, $addressType = 'shipping')
    {
        $addresses = $addressType === 'shipping' ? $this->shippingAddresses : $this->billingAddresses;
        $address = collect($addresses)->firstWhere('id', $addressId);
        
        if ($address) {
            $this->editingAddressId = $address->id;
            $this->address_type = $address->address_type;
            $this->isEditing = true;
            $this->showAddressForm = true;

            // Fill form with address data
            $this->first_name = $address->first_name;
            $this->last_name = $address->last_name;
            $this->phone_no = $address->phone_no;
            $this->email = $address->email;
            $this->address_line_1 = $address->address_line_1;
            $this->address_line_2 = $address->address_line_2;
            $this->postal_code = $address->postal_code;
            $this->city = $address->city;
            $this->state = $address->state;
            $this->landmark = $address->landmark;
            $this->alt_phone_no = $address->alt_phone_no;
            $this->additional_notes = $address->additional_notes;
            $this->is_default = $address->is_default;
            $this->country_code = $address->country_code;
        }
    }

    public function closeAddressForm()
    {
        $this->showAddressForm = false;
        $this->isEditing = false;
        $this->editingAddressId = null;
        $this->resetFormFields();
    }

    public function saveAddress()
    {
        // Use StoreAddressRequest rules for validation
        $request = new StoreAddressRequest();
        $this->validate($request->rules(), [], $request->attributes());

        // Ensure address_type and user_id are present
        $payload = [
            'user_id' => $this->user->id ?? $this->user_id,
            'address_type' => $this->address_type,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'country_code' => $this->country_code ?: (defined('COUNTRY') ? COUNTRY['country'] : 'IN'),
            'phone_no' => $this->phone_no,
            'email' => $this->email,
            'landmark' => $this->landmark,
            'additional_notes' => $this->additional_notes ?? null,
            'alt_phone_no' => $this->alt_phone_no,
            'is_default' => $this->is_default ? 1 : 0,
        ];

        if ($this->isEditing && $this->editingAddressId) {
            // Update existing address
            $payload['id'] = $this->editingAddressId;
            $resp = $this->addressRepository->update($payload);
            $successMessage = 'Address updated successfully';
        } else {
            // Create new address
            $resp = $this->addressRepository->store($payload);
            $successMessage = 'Address saved successfully';
        }

        if (isset($resp['code']) && $resp['code'] == 200) {
            $this->getAddresses();
            $this->resetFormFields();
            $this->closeAddressForm();

            // update payment methods or other listeners
            $this->dispatch('updatePaymentMethodsAction');

            $this->dispatch('show-notification', $resp['message'] ?? $successMessage, ['type' => 'success']);
            return;
        } else {
            $this->dispatch('show-notification', $resp['message'] ?? 'Unable to save address', ['type' => 'warning']);
            return;
        }
    }

    public function resetFormFields()
    {
        $this->reset([
            'first_name', 'last_name', 'phone_no', 'email',
            'address_line_1', 'address_line_2', 'postal_code',
            'city', 'state', 'landmark', 'alt_phone_no', 'is_default', 'additional_notes'
        ]);

        // Reset to user defaults
        $this->first_name = $this->user->first_name ?? '';
        $this->last_name = $this->user->last_name ?? '';
        $this->phone_no = $this->user->primary_phone_no ?? '';
        $this->email = $this->user->email ?? '';
        $this->is_default = 1;

        // default back to shipping
        $this->address_type = 'shipping';
    }

    public function getAddresses()
    {
        // Assuming user relations are loaded & available
        $this->shippingAddresses = $this->user->shippingAddresses ?? [];
        $this->billingAddresses = $this->user->billingAddresses ?? [];

        $this->shippingAddressesCount = is_countable($this->shippingAddresses) ? count($this->shippingAddresses) : 0;
        $this->billingAddressesCount = is_countable($this->billingAddresses) ? count($this->billingAddresses) : 0;
    }

    public function getStates()
    {
        $statesData = $this->stateRepository->list('', ['country_code' => (defined('COUNTRY') ? COUNTRY['country'] : 'IN')], 'all', 'name', 'asc');
        $this->states = $statesData['data'] ?? [];
    }

    /**
     * Delete address
     */
    public function deleteAddress($addressId)
    {
        try {
            $resp = $this->addressRepository->delete($addressId);

            if (isset($resp['code']) && $resp['code'] == 200) {
                $this->getAddresses();

                // Dispatch events if needed
                $this->dispatch('updatePaymentMethodsAction');
                $this->dispatch('show-notification', 'Address removed', ['type' => 'success']);

                // Close modal
                $this->dispatch('close-modal', 'confirm-checkout-address-delete');
            } else {
                $this->dispatch('show-notification', $resp['message'] ?? 'Unable to delete address', ['type' => 'error']);
            }
        } catch (\Exception $e) {
            $this->dispatch('show-notification', 'Error deleting address', ['type' => 'error']);
        }
    }

    /**
     * Set address data for deletion confirmation modal
     */
    public function setAddressForDeletion($addressId, $addressType = 'shipping')
    {
        $addresses = $addressType === 'shipping' ? $this->shippingAddresses : $this->billingAddresses;
        $address = collect($addresses)->firstWhere('id', $addressId);
        
        if ($address) {
            $this->dispatch('set-address-deletion-data', 
                id: $address->id,
                name: $address->first_name . ' ' . $address->last_name,
                addressline1: $address->address_line_1,
                addressline2: $address->address_line_2,
                landmark: $address->landmark ?? '',
                city: $address->city,
                state: strtoupper($address->stateDetail->name ?? ''),
                postalcode: $address->postal_code,
                country: strtoupper($address->countryDetail->name ?? '')
            );
            
            $this->dispatch('open-modal', 'confirm-checkout-address-delete');
        }
    }

    public function render()
    {
        return view('livewire.checkout-address');
    }
}