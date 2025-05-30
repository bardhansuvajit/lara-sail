<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\CartInterface;

class PaymentMethod extends Component
{
    public Int $shippingAddrExistCount;
    public ?string $selectedMethod = null;
    public Collection $paymentMethods;
    private PaymentMethodInterface $paymentMethodRepository;
    private CartInterface $cartRepository;

    public function mount(
        $shippingAddrExistCount, 
        PaymentMethodInterface $paymentMethodRepository,
        CartInterface $cartRepository
    )
    {
        $this->shippingAddrExistCount = $shippingAddrExistCount;

        // Find Payment Methods
        $paymentMethodRepository = app(PaymentMethodInterface::class);
        $this->paymentMethods = $paymentMethodRepository->list('', ['status' => 1, 'country_code' => COUNTRY['country']], 'all', 'position', 'asc')['data'];

        // Set default selected method
        if ($this->paymentMethods->isNotEmpty()) {
            $this->selectedMethod = $this->paymentMethods->first()->method;
        }
    }

    public function updatedselectedMethod($id)
    {
        // $this->dispatch('open-modal', name: 'full-page-loader');

        // Get Cart Data
        $cartRepository = app(CartInterface::class);
        if (auth()->guard('web')->check()) {
            $cart = $cartRepository->exists([
                'user_id' => auth()->guard('web')->user()->id
            ])['data'];

            $updtResp = $cartRepository->updatePaymentMethod($id, $cart->id);
            $this->dispatch('show-notification', 
                'Payment method updated', ['type' => 'success']
            );
            // dd($updtResp);
            $this->dispatch('updateCartData');
            // dd($paymentData);
        }
    }

    public function render()
    {
        return view('livewire.payment-method');
    }
}
