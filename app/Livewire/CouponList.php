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

            // Get user/device info
            // $userId = null;
            // $deviceId = null;

            // if (auth()->guard('web')->check()) {
            //     $userId = auth()->guard('web')->user()->id;
            //     $cart = $cartRepository->exists([
            //         'user_id' => $userId
            //     ]);
            // } else {
            //     $deviceId = $_COOKIE['device_id'] ?? Str::uuid();
            //     $cart = $cartRepository->exists([
            //         'device_id' => $deviceId
            //     ]);
            // }

            // dd($cart['data']->items);
            $deviceId = $_COOKIE['device_id'] ?? Str::uuid();
            $userId = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null;

            $couponApplyResp = $couponRepository->checkAndApplyToCart($couponCode, $userId, $deviceId);

            // dd($couponApplyResp);

            if ($couponApplyResp['code'] == 200) {
                $this->dispatch('show-notification', 
                    'Coupon applied successfully!', ['type' => 'success']
                );
                $this->voucherInput = '';
            } else {
                $this->dispatch('show-notification', 
                    $couponApplyResp['message'] ?? 'Failed to apply coupon !', 
                    ['type' => 'warning']
                );
            }

        } catch (\Exception $e) {
            $this->dispatch('show-notification', 
                'Failed to apply coupon. Please try again.', 
                ['type' => 'error']
            );
            logger()->error('Coupon application failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.coupon-list');
    }
}