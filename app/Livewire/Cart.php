<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\CartInterface;
use App\Interfaces\CartItemInterface;
use App\Interfaces\CartSettingInterface;
use App\Interfaces\ShippingMethodInterface;
use Illuminate\Support\Str;

class Cart extends Component
{
    public String $page;
    public Collection $cart;
    public Collection $savedItems;
    public Collection $shippingMethods;
    public Collection $cartSetting;
    public ?Int $selectedShippingMethod;
    private CartInterface $cartRepository;
    private CartItemInterface $cartItemRepository;
    private CartSettingInterface $cartSettingRepository;
    private ShippingMethodInterface $shippingMethodRepository;
    protected $listeners = ['updateCartInfo' => 'getCartData'];

    public function mount(
        CartInterface $cartRepository, 
        CartItemInterface $cartItemRepository, 
        CartSettingInterface $cartSettingRepository,
        ShippingMethodInterface $shippingMethodRepository
    )
    {
        $this->page = 'cart';
        $this->itemData = [];
        $this->getCartData();
    }

    public function getCartData()
    {
        $this->dispatch('showFullPageLoader');

        $country = COUNTRY['country'];

        // Get Cart Setting
        $cartSettingRepository = app(CartSettingInterface::class);
        $cartSettingData = $cartSettingRepository->exists([
            'country' => $country
        ])['data'];
        $this->cartSetting = collect($cartSettingData);

        // dd($cartSettings);

        // Get Cart Data
        $cartRepository = app(CartInterface::class);

        if (auth()->guard('web')->check()) {
            $cart = $cartRepository->exists([
                'user_id' => auth()->guard('web')->id()
            ]);
        } else {
            $deviceId = $_COOKIE['device_id'] ?? Str::uuid();

            $cart = $cartRepository->exists([
                'device_id' => $deviceId,
            ]);
        }

        // Update cart totals, if cart data exists
        if (!empty($cart['data'])) {
            $cartUpdateResp = $cartRepository->updateCartTotals($cart['data']);
        }
        // dd($cartUpdateResp);
        // dd($cart['data']);

        // $shippingMethodRepository = app(ShippingMethodInterface::class);
        // dd($shippingMethodRepository->exists([
        //     'country_code' => $country
        // ]));

        // Get Shipping Methods
        $shippingMethodRepository = app(ShippingMethodInterface::class);
        $shippingMethods = $shippingMethodRepository->list('', ['country_code' => $country], 'all', 'position', 'asc')['data'];

        // $this->cart = collect($cart['data']->items);
        $this->cart = collect($cart['data'] ?? []);
        $this->savedItems = collect($cart['data']->savedItems ?? []);
        $this->shippingMethods = collect($shippingMethods ?? []);
        $this->selectedShippingMethod = $cart['data']->shipping_method_id ?? null;
        // $this->savedItems = count($cart['data']) > 0 ? collect($cart['data']->savedItems) : collect([]);

        $this->dispatch('hideFullPageLoader');
    }

    public function updateQty($id, $type, $currentQty)
    {
        $this->dispatch('showFullPageLoader');

        // dd($id, $type);
        $currentQty = (int)$currentQty;

        // Check for minimum quantity (1)
        if ($type === 'desc' && $currentQty <= 1) {
            $this->dispatch('show-notification', 
                'Minimum cart quantity is 1', ['type' => 'warning']
            );
            return;
        }

        try {
            $cartRepository = app(CartInterface::class);
            $cartItemRepository = app(CartItemInterface::class);

            $resp = $cartItemRepository->qtyUpdate([
                'id' => $id,
                'type' => $type
            ]);

            // dd($resp);

            $cart = $resp['cart'];
            // Update cart totals
            $cartResponse = $cartRepository->updateCartTotals($cart);

            $this->dispatch('show-notification', 
                'Cart updated successfully', ['type' => 'success']
            );

            $this->getCartData();
        } catch (\Throwable $th) {
            $this->dispatch('show-notification', 
                'Cart action error', ['type' => 'error']
            );
        }

        $this->dispatch('hideFullPageLoader');
    }

    public function deleteItem($id)
    {
        $this->dispatch('showFullPageLoader');

        try {
            $cartRepository = app(CartInterface::class);
            $cartItemRepository = app(CartItemInterface::class);
            $resp = $cartItemRepository->delete($id);

            $cart = $resp['cart'];
            // Update cart totals
            $cartResponse = $cartRepository->updateCartTotals($cart);

            if ($resp['code'] == 200) {
                $this->dispatch('show-notification', 
                    'Cart updated successfully', ['type' => 'success']
                );

                $this->getCartData();
                $this->dispatch('close-modal', 'confirm-livewire-cart-item-deletion');
            } else {
                $this->dispatch('show-notification', 
                    'Cart action error', ['type' => 'error']
                );
            }
        } catch (\Throwable $th) {
            $this->dispatch('show-notification', 
                'Cart action error', ['type' => 'error']
            );
        }

        $this->dispatch('hideFullPageLoader');
    }

    public function saveItemForLater($id)
    {
        $this->dispatch('showFullPageLoader');

        try {
            $cartRepository = app(CartInterface::class);
            $cartItemRepository = app(CartItemInterface::class);
            $resp = $cartItemRepository->saveForLater($id);

            $cart = $resp['cart'];
            // Update cart totals
            $cartResponse = $cartRepository->updateCartTotals($cart);

            if ($resp['code'] == 200) {
                $this->dispatch('show-notification', 
                    'Product saved for later', ['type' => 'success']
                );

                $this->getCartData();
                $this->dispatch('close-modal', 'confirm-livewire-cart-item-save-for-later');
            } else {
                $this->dispatch('show-notification', 
                    'Cart action error', ['type' => 'error']
                );
            }
        } catch (\Throwable $th) {
            $this->dispatch('show-notification', 
                'Cart action error', ['type' => 'error']
            );
        }

        $this->dispatch('hideFullPageLoader');
    }

    public function moveItemToCart($id)
    {
        $this->dispatch('showFullPageLoader');

        try {
            $cartRepository = app(CartInterface::class);
            $cartItemRepository = app(CartItemInterface::class);
            $resp = $cartItemRepository->moveToCart($id);

            $cart = $resp['cart'];
            // Update cart totals
            $cartResponse = $cartRepository->updateCartTotals($cart);

            if ($resp['code'] == 200) {
                $this->dispatch('show-notification', 
                    'Product moved to cart', ['type' => 'success']
                );

                $this->getCartData();
                $this->dispatch('close-modal', 'confirm-livewire-cart-item-save-for-later');
            } else {
                $this->dispatch('show-notification', 
                    'Cart action error', ['type' => 'error']
                );
            }
        } catch (\Throwable $th) {
            $this->dispatch('show-notification', 
                'Cart action error', ['type' => 'error']
            );
        }

        $this->dispatch('hideFullPageLoader');
    }

    public function updatedselectedShippingMethod($id)
    {
        $this->dispatch('showFullPageLoader');

        // Get Cart Data
        $cartRepository = app(CartInterface::class);
        if (auth()->guard('web')->check()) {
            $cart = $cartRepository->exists([
                'user_id' => auth()->guard('web')->user()->id
            ])['data'];
        } else {
            $deviceId = $_COOKIE['device_id'] ?? Str::uuid();

            $cart = $cartRepository->exists([
                'device_id' => $deviceId,
            ])['data'];
        }

        $updtResp = $cartRepository->updateShippingMethod($id, $cart->id);
        $this->dispatch('show-notification', 
            'Shipping method updated', ['type' => 'success']
        );
        $this->getCartData();
        // $this->emit('updateCartInfo');
        $this->dispatch('hideFullPageLoader');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
