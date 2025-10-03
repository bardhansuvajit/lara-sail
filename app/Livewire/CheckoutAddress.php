<?php

namespace App\Livewire;

use Livewire\Component;
use App\Interfaces\StateInterface;

class CheckoutAddress extends Component
{
    public $user;
    public $states = [];
    public $shippingAddresses = [];
    public $billingAddresses = [];
    public int $shippingAddressesCount = 0;
    public int $billingAddressesCount = 0;

    private StateInterface $stateRepository;

    public function boot(StateInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function mount()
    {
        $this->user = auth()->guard('web')->user();

        if ($this->user) {
            $this->getAddresses();
        }

        $this->getStates();
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
