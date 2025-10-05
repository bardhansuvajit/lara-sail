<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\CartInterface;
use Livewire\Attributes\On;

class CheckoutPaymentMethod extends Component
{
    public $user;
    public int $shippingAddressesCount = 0;
    public ?string $selectedMethod = null;
    public Collection $paymentMethods;

    private PaymentMethodInterface $paymentMethodRepository;
    private CartInterface $cartRepository;

    public function boot(
        PaymentMethodInterface $paymentMethodRepository,
        CartInterface $cartRepository
    )
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->cartRepository = $cartRepository;
    }

    #[On('updatePaymentMethodsAction')]
    public function mount()
    {
        $this->user = auth()->guard('web')->user();

        // Count shipping addresses
        $this->shippingAddressesCount = $this->user
            ? count($this->user->shippingAddresses ?? [])
            : 0;

        $this->loadPaymentMethods();
    }

    /**
     * Load payment methods from repository
     */
    public function loadPaymentMethods(): void
    {
        $methods = $this->paymentMethodRepository->list(
            '',
            ['status' => 1, 'country_code' => COUNTRY['country']],
            'all',
            'position',
            'asc'
        );

        $this->paymentMethods = collect($methods['data'] ?? []);

        // Set default selected method
        if ($this->paymentMethods->isNotEmpty()) {
            $this->selectedMethod = $this->paymentMethods->first()->method;
        }
    }

    public function updatedSelectedMethod($id)
    {
        $this->dispatch('showFullPageLoader');

        if ($this->user) {
            $cart = $this->cartRepository->exists([
                'user_id' => $this->user->id
            ])['data'];

            $this->cartRepository->updatePaymentMethod($id, $cart->id);

            $this->dispatch('show-notification', 'Payment method updated', ['type' => 'success']);
            $this->dispatch('updateCartData');
        }

        $this->dispatch('hideFullPageLoader');
    }

    public function render()
    {
        return view('livewire.checkout-payment-method');
    }
}
