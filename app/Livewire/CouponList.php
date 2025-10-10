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
    public ?string $appliedCouponCode = null;

    // Flag to trigger one-time apply from query param
    public bool $applyQueryCoupon = false;
    protected $listeners = ['updateCartDataAttr' => 'refreshAppliedCoupon'];

    public function mount(): void
    {
        $this->country = COUNTRY['country'] ?? 'IN';
        $this->loadCoupons();
        $this->refreshAppliedCoupon();

        // Auto-apply coupon if URL has ?coupon=CODE
        $couponCode = request('coupon');
        if (!empty($couponCode)) {
            $this->voucherInput = $couponCode;
            // mark to apply after render (and after loading finishes)
            $this->applyQueryCoupon = true;
        }
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

            $deviceId = $_COOKIE['device_id'] ?? Str::uuid();
            $userId = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null;

            if (!is_null($userId)) {
                $cart = $cartRepository->exists(['user_id' => $userId]);
            } else {
                $cart = $cartRepository->exists(['device_id' => $deviceId]);
            }

            // Check if cart exists and has items
            if ($cart['code'] != 200 || empty($cart['data']->items)) {
                $this->dispatch('show-notification', 
                    'Your cart is empty! Please add some items to cart first.', 
                    ['type' => 'warning']
                );
                $this->dispatch('hideFullPageLoader');

                // IMPORTANT: stop further execution if cart is missing/empty
                return;
            }

            $couponApplyResp = $couponRepository->checkAndApplyToCart($couponCode, $cart['data']);

            if ($couponApplyResp['code'] == 200) {
                $this->dispatch('show-notification', 
                    'Coupon applied successfully!', ['type' => 'success']
                );
                $this->voucherInput = '';

                $this->refreshAppliedCoupon();
                // for Cart page
                $this->dispatch('updateCartDataAttr');
                // for Checkout page
                $this->dispatch('updateCartDataAttrInCheckout');
                // $this->dispatch('hideFullPageLoader');
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

            $this->dispatch('hideFullPageLoader');
        }
    }

    public function rendered(): void
    {
        // Only auto-apply once, and only after loadCoupons finished
        if ($this->applyQueryCoupon && !$this->isLoading) {
            // use json_encode for safe JS string embedding
            $codeJson = json_encode($this->voucherInput);

            // call applyCoupon on the client side and remove coupon param so refresh won't reapply
            $this->js("
                (function(){
                    const code = {$codeJson};
                    setTimeout(() => {
                        try {
                            \$wire.applyCoupon(code);
                        } catch (e) {
                            console.error('Auto apply coupon failed', e);
                        }
                        try {
                            const u = new URL(location.href);
                            u.searchParams.delete('coupon');
                            history.replaceState(null, '', u.toString());
                        } catch (er) {}
                    }, 100);
                })();
            ");

            // prevent re-triggering
            $this->applyQueryCoupon = false;
        }
    }

    public function refreshAppliedCoupon(): void
    {
        $cartRepo = app(\App\Interfaces\CartInterface::class);
        $deviceId = $_COOKIE['device_id'] ?? \Illuminate\Support\Str::uuid();
        $userId = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null;

        $cartResp = !is_null($userId)
            ? $cartRepo->exists(['user_id' => $userId])
            : $cartRepo->exists(['device_id' => $deviceId]);

        $cart = $cartResp['data'] ?? null;

        // adapt the key to your repo's shape:
        $this->appliedCouponCode = $cart->coupon_code ?? null;
    }

    public function render()
    {
        return view('livewire.coupon-list');
    }
}
