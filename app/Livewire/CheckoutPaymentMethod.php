<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\CartInterface;
use Livewire\Attributes\On;

class CheckoutPaymentMethod extends Component
{
    public $user;
    public int $shippingAddressesCount = 0;
    public ?string $selectedMethod = null;
    public ?string $selectedGateway = null;
    public Collection $paymentMethods;
    public Collection $paymentGateways;

    // These will store the currently selected addresses from the form
    public $shipping_address_id;
    public $billing_address_id;

    private PaymentMethodInterface $paymentMethodRepository;
    private PaymentGatewayInterface $paymentGatewayRepository;
    private CartInterface $cartRepository;

    public function boot(
        PaymentMethodInterface $paymentMethodRepository,
        PaymentGatewayInterface $paymentGatewayRepository,
        CartInterface $cartRepository
    )
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentGatewayRepository = $paymentGatewayRepository;
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
        $this->loadPaymentGateways();

        // Set default addresses if available
        $this->setDefaultAddresses();
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
            $this->selectedMethod = $this->paymentMethods->first()->id;
        }
    }

    public function loadPaymentGateways(): void
    {
        $gateways = $this->paymentGatewayRepository->list(
            '',
            ['status' => 1, 'country_code' => COUNTRY['country']],
            'all',
            'position',
            'asc'
        );

        $this->paymentGateways = collect($gateways['data'] ?? []);

        // Set default selected gateway
        if ($this->paymentGateways->isNotEmpty()) {
            $this->selectedGateway = $this->paymentGateways->first()->id;
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

    /**
     * Set default addresses from user's addresses
     */
    private function setDefaultAddresses(): void
    {
        if ($this->user && $this->user->shippingAddresses->isNotEmpty()) {
            $defaultShipping = $this->user->shippingAddresses->firstWhere('is_default', 1);
            $this->shipping_address_id = $defaultShipping ? $defaultShipping->id : $this->user->shippingAddresses->first()->id;
        }

        if ($this->user && $this->user->billingAddresses->isNotEmpty()) {
            $defaultBilling = $this->user->billingAddresses->firstWhere('is_default', 1);
            $this->billing_address_id = $defaultBilling ? $defaultBilling->id : $this->user->billingAddresses->first()->id;
        }
    }

    /**
     * Listen for address selection changes from the form
     */
    #[On('addressSelected')]
    public function updateSelectedAddresses($shippingAddressId = null, $billingAddressId = null)
    {
        if ($shippingAddressId) {
            $this->shipping_address_id = $shippingAddressId;
        }
        if ($billingAddressId) {
            $this->billing_address_id = $billingAddressId;
        }
    }

    // In CheckoutPaymentMethod.php
    public function initiateOnlinePayment($gatewayId)
    {
        $this->dispatch('showFullPageLoader');

        try {
            if ($gatewayId != 1) {
                $this->dispatch('hideFullPageLoader');
                $this->dispatch('show-notification', 'Please select Razorpay only', ['type' => 'error']);
                return;
            }

            // Validate required fields
            if (!$this->shipping_address_id) {
                $this->dispatch('hideFullPageLoader');
                $this->dispatch('show-notification', 'Please select a shipping address', ['type' => 'error']);
                return;
            }

            if (!$this->selectedMethod) {
                $this->dispatch('hideFullPageLoader');
                $this->dispatch('show-notification', 'Please select a payment method', ['type' => 'error']);
                return;
            }

            // Build URL with query parameters
            $url = route('front.payment.initiate', ['gateway_id' => $gatewayId]) . '?' . http_build_query([
                'payment_method_id' => $this->selectedMethod,
                'shipping_address_id' => $this->shipping_address_id,
                'billing_address_id' => $this->billing_address_id
            ]);

            // Use wire:navigate for SPA-like navigation or return redirect
            return redirect()->to($url);

        } catch (\Exception $e) {
            $this->dispatch('hideFullPageLoader');
            $this->dispatch('show-notification', 'Payment initiation failed: ' . $e->getMessage(), ['type' => 'error']);
            return null;
        }
    }

    /*
    public function initiateOnlinePayment($gatewayId)
    {
        $this->dispatch('showFullPageLoader');
        
        try {
            // Validate required fields - use the current component state
            if (!$this->shipping_address_id) {
                $this->dispatch('hideFullPageLoader');
                $this->dispatch('show-notification', 'Please select a shipping address', ['type' => 'error']);
                return;
            }

            if (!$this->selectedMethod) {
                $this->dispatch('hideFullPageLoader');
                $this->dispatch('show-notification', 'Please select a payment method', ['type' => 'error']);
                return;
            }

            // Redirect to payment initiation with all required data
            return redirect()->route('front.payment.initiate', [
                'gateway_id' => $gatewayId,
                'payment_method_id' => $this->selectedMethod,
                'shipping_address_id' => $this->shipping_address_id,
                'billing_address_id' => $this->billing_address_id
            ]);

        } catch (\Exception $e) {
            $this->dispatch('hideFullPageLoader');
            $this->dispatch('show-notification', 'Payment initiation failed: ' . $e->getMessage(), ['type' => 'error']);
        }
    }
    */

    public function getSelectedMethodTypeProperty()
    {
        $selectedMethod = $this->paymentMethods->firstWhere('id', $this->selectedMethod);
        return $selectedMethod->method ?? 'cod';
    }

    public function render()
    {
        return view('livewire.checkout-payment-method');
    }
}