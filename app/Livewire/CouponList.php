<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\CouponInterface;
use Livewire\Attributes\Computed;
use Illuminate\Support\Carbon;

class CouponList extends Component
{
    public Collection $coupons;
    public bool $isLoading = true;
    public bool $hasError = false;
    public string $errorMessage = '';
    public string $copiedCode = ''; // Track the currently copied coupon
    public bool $showCopiedFeedback = false;
    
    private string $country;
    private CouponInterface $couponRepository;

    public function mount(CouponInterface $couponRepository): void
    {
        $this->country = COUNTRY['country'] ?? 'IN';
        $this->couponRepository = $couponRepository;
        $this->loadCoupons();
    }

    public function loadCoupons(): void
    {
        try {
            $this->isLoading = true;
            $this->hasError = false;
            
            $coupons = $this->couponRepository->listCountryBasedFrontendCoupons($this->country);
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
        $this->showCopiedFeedback = true;
        
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
        
        // Reset after 2 seconds using JavaScript
        $this->js("
            setTimeout(() => {
                \$wire.set('copiedCode', '');
                \$wire.set('showCopiedFeedback', false);
            }, 2000);
        ");
    }

    public function render()
    {
        return view('livewire.coupon-list');
    }
}