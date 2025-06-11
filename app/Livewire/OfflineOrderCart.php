<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\CartInterface;
use App\Interfaces\CartItemInterface;
use App\Interfaces\CartSettingInterface;
use Illuminate\Support\Str;

class OfflineOrderCart extends Component
{
    public Int $userId;
    public String $page;
    public Collection $cart;
    public Collection $savedItems;
    public Collection $cartSetting;
    private CartInterface $cartRepository;
    private CartItemInterface $cartItemRepository;
    private CartSettingInterface $cartSettingRepository;
    protected $listeners = ['updateCartData' => 'getCartDataWOPaymentMethodUpdate'];

    public function mount(
        Int $userId,
        CartInterface $cartRepository, 
        CartItemInterface $cartItemRepository, 
        CartSettingInterface $cartSettingRepository
    )
    {
        $this->userId = $userId;
        $this->page = 'offline-order';
        $this->itemData = [];
        $this->getCartData();
    }

    public function getCartData()
    {
        $country = COUNTRY['country'];

        // Get Cart Setting
        $cartSettingRepository = app(CartSettingInterface::class);
        $cartSettingData = $cartSettingRepository->exists([
            'country' => $country
        ])['data'];
        $this->cartSetting = collect($cartSettingData);

        // dd($cartSetting);

        // Get Cart Data
        $cartRepository = app(CartInterface::class);

        /*
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
        */

        $cart = $cartRepository->exists([
            'user_id' => $this->userId
        ]);

        // Update cart totals, if cart data exists
        if (!empty($cart['data'])) {
            $cartUpdateResp = $cartRepository->updateCartTotals($cart['data']);
        }
        // dd($cartUpdateResp);
        // dd($cart['data']);

        // $this->cart = collect($cart['data']->items);
        $this->cart = collect($cart['data'] ?? []);
        $this->savedItems = collect($cart['data']->savedItems ?? []);

        // $this->savedItems = count($cart['data']) > 0 ? collect($cart['data']->savedItems) : collect([]);
    }

    public function getCartDataWOPaymentMethodUpdate()
    {
        $country = COUNTRY['country'];

        // Get Cart Setting
        $cartSettingRepository = app(CartSettingInterface::class);
        $cartSettingData = $cartSettingRepository->exists([
            'country' => $country
        ])['data'];
        $this->cartSetting = collect($cartSettingData);

        // dd($cartSetting);

        // Get Cart Data
        $cartRepository = app(CartInterface::class);

        /*
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
        */

        $cart = $cartRepository->exists([
            'user_id' => $this->userId
        ]);

        // Update cart totals, if cart data exists
        // if (!empty($cart['data'])) {
        //     $cartUpdateResp = $cartRepository->updateCartTotals($cart['data']);
        // }

        $this->cart = collect($cart['data'] ?? []);
        $this->savedItems = collect($cart['data']->savedItems ?? []);
    }

    public function updateQty($id, $type, $currentQty)
    {
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
    }

    public function deleteItem($id)
    {
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
    }

    public function saveItemForLater($id)
    {
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
    }

    public function moveItemToCart($id)
    {
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
    }

    public function render()
    {
        return view('livewire.offline-order-cart');
    }
}
