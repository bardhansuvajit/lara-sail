<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Interfaces\CouponInterface;
use App\Interfaces\CartInterface;

class CouponList extends Component
{
    public Collection $coupons;
    public bool $isLoading = true;
    public bool $hasError = false;
    public string $errorMessage = '';
    public string $copiedCode = '';
    public bool $showCopiedFeedback = false;
    public string $voucherInput = '';

    private string $country;

    public function mount(): void
    {
        $this->country = COUNTRY['country'] ?? 'IN';
        $this->loadCoupons();
    }

    public function loadCoupons(): void
    {
        try {
            $this->isLoading = true;
            $this->hasError = false;

            $couponRepository = app(CouponInterface::class);
            $coupons = $couponRepository->listCountryBasedFrontendCoupons($this->country);
            $this->coupons = $coupons['data'] ?? collect();
        } catch (\Exception $e) {
            $this->hasError = true;
            $this->errorMessage = 'Failed to load coupons. Please try again.';
            $this->coupons = collect();
            logger()->error('Coupon loading failed: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function refreshCoupons(): void
    {
        $this->loadCoupons();
    }

    #[Computed]
    public function activeCoupons(): Collection
    {
        $now = Carbon::now();

        return $this->coupons
            ->where('status', 1)
            ->where('show_in_frontend', true)
            ->where('starts_at', '<=', $now)
            ->where('expires_at', '>=', $now)
            ->filter(function ($coupon) {
                if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                    return false;
                }
                return true;
            })
            ->sortBy('position');
    }

    #[Computed]
    public function hasActiveCoupons(): bool
    {
        return $this->activeCoupons->isNotEmpty();
    }

    public function copyCouponCode(string $code): void
    {
        $this->copiedCode = $code;
        $this->voucherInput = $code;

        $this->js("
            navigator.clipboard.writeText('{$code}').then(() => {
                // Success - state already updated
            }).catch(err => {
                console.error('Failed to copy coupon code: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = '{$code}';
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
            });
        ");

        $this->js("
            setTimeout(() => {
                \$wire.set('copiedCode', '');
            }, 2000);
        ");
    }

    public function applyCoupon(string $code = null): void
    {
        $this->dispatch('showFullPageLoader');
        $couponCode = $code ?: $this->voucherInput;

        if (empty($couponCode)) {
            $this->dispatch('show-notification', 
                'Please enter a coupon code', ['type' => 'warning']
            );
            return;
        }

        try {
            $couponRepository = app(CouponInterface::class);
            $cartRepository = app(CartInterface::class);

            // dd($cart['data']->items);
            $deviceId = $_COOKIE['device_id'] ?? Str::uuid();
            $userId = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null;

            if (!is_null($userId)) {
                $cart = $cartRepository->exists(['user_id' => $userId]);
            } else {
                $cart = $cartRepository->exists(['device_id' => $deviceId]);
            }

            // dd($cart);

            // Check if cart exists and has items
            if ($cart['code'] != 200 || empty($cart['data']->items)) {
                $this->dispatch('show-notification', 
                    'Your cart is empty! Please add some items to cart first.', 
                    ['type' => 'warning']
                );
                $this->dispatch('hideFullPageLoader');
                // return [
                //     'success' => false,
                //     'code' => 400,
                //     'status' => 'error',
                //     'message' => 'Your cart is empty! Please add some items to cart first.',
                // ];
            }

            $couponApplyResp = $couponRepository->checkAndApplyToCart($couponCode, $cart['data']);

            // dd($couponApplyResp);

            if ($couponApplyResp['code'] == 200) {
                $this->dispatch('show-notification', 
                    'Coupon applied successfully!', ['type' => 'success']
                );
                $this->voucherInput = '';

                $this->dispatch('updateCartDataAttr');
            } else {
                $this->dispatch('show-notification', 
                    $couponApplyResp['message'] ?? 'Failed to apply coupon !', 
                    ['type' => 'warning']
                );
                $this->dispatch('hideFullPageLoader');
            }


        } catch (\Exception $e) {
            $this->dispatch('show-notification', 
                'Failed to apply coupon. Please try again.', 
                ['type' => 'error']
            );
            logger()->error('Coupon application failed: ' . $e->getMessage());

            // $this->dispatch('hideFullPageLoader');
        }
    }

    public function render()
    {
        return view('livewire.coupon-list');
    }
}