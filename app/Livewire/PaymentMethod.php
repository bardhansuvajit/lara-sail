<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\PaymentMethodInterface;

class PaymentMethod extends Component
{
    public Int $shippingAddrExistCount;
    public Collection $paymentMethods;
    private PaymentMethodInterface $paymentMethodRepository;

    public function mount($shippingAddrExistCount, PaymentMethodInterface $paymentMethodRepository)
    {
        $this->shippingAddrExistCount = $shippingAddrExistCount;

        // Find Payment Methods
        $paymentMethodRepository = app(PaymentMethodInterface::class);
        $this->paymentMethods = $paymentMethodRepository->list('', ['status' => 1, 'country_code' => COUNTRY['country']], 'all', 'position', 'asc')['data'];
    }

    public function render()
    {
        return view('livewire.payment-method');
    }
}
