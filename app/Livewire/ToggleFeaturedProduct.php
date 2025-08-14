<?php

namespace App\Livewire;

use Livewire\Component;
use App\Interfaces\ProductFeatureInterface;

class ToggleFeaturedProduct extends Component
{
    public $productTitle;
    public $productId;
    public $featureType;

    protected ProductFeatureInterface $productFeatureRepository;

    public function boot(ProductFeatureInterface $productFeatureRepository)
    {
        $this->productFeatureRepository = $productFeatureRepository;
    }

    public function updateFeatureType(string $value)
    {
        $this->featureType = $value;

        // dd($value);

        $data = $this->productFeatureRepository->getByProductId($this->productId);

        // If Data already Featured
        if ($data['code'] == 200 && !empty($data['data'])) {
            if ($value === 'off') {
                if ($data['code'] == 200) {
                    $this->productFeatureRepository->delete($data['data']['id']);

                    // Delay dispatch to avoid DOM removal mid-request
                    $this->dispatch('notificationSend', [
                        'variant' => 'success',
                        'title' => 'Status updated',
                        'message' => "{$this->productTitle} removed from features"
                    ]);

                    $this->dispatch('productEnabled')->self(); // only to this component first

                    $this->dispatch('productEnabled')->to(FeatureProductSetup::class); // trigger parent after render

                    return;
                }
                return;
            }

            $this->productFeatureRepository->update($data['data']['id'], [
                'type' => $value
            ]);

            $this->dispatch('productEnabled');

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Status updated',
                'message' => "{$this->productTitle} updated to {$value}"
            ]);
        }
        // If Data not featured
        else {
            if ($value === 'off') {
                $this->dispatch('productEnabled');

                $this->dispatch('notificationSend', [
                    'variant' => 'warning',
                    'title' => 'OOPS!',
                    'message' => "This action cannot be performed!"
                ]);
                return;
            }

            $this->productFeatureRepository->store([
                'product_id' => $this->productId,
                'type' => $value
            ]);

            $this->dispatch('productEnabled');

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Status updated',
                'message' => "{$this->productTitle} added as {$value}"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.toggle-featured-product');
    }
}
