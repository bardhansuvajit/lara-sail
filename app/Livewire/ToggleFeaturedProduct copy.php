<?php

namespace App\Livewire;

use Livewire\Component;
use App\Interfaces\ProductFeatureInterface;
use Livewire\Attributes\On;

class ToggleFeaturedProduct extends Component
{
    public $productTitle;
    public $productId;
    public $featureId;
    private ProductFeatureInterface $productFeatureRepository;

    public function mount($productTitle, $productId, $featureId, ProductFeatureInterface $productFeatureRepository)
    {
        $this->productTitle = $productTitle;
        $this->productId = $productId;
        $this->featureId = $featureId;
    }

    public function toggle()
    {
        $productFeatureRepository = app(ProductFeatureInterface::class);
        $data = $productFeatureRepository->getByProductId($this->productId);

        if($data['code'] == 200) {
            // $productFeatureRepository->delete($data['data']->id);

            // $this->dispatch('notificationSend', [
            //     'variant' => 'success',
            //     'title' => 'Status updated',
            //     'message' => $this->productTitle . ' is removed'
            // ]);

            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => 'This action cannot be performed from here',
                // 'message' => $this->productTitle . ' is removed'
            ]);
        } else {
            $createArray = [
                'product_id' => $this->productId,
                'position' => 1,
            ];

            $storeResp = $productFeatureRepository->store($createArray);

            $this->dispatch('productEnabled');

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Status updated',
                'message' => $this->productTitle . ' is added'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.toggle-featured-product');
    }
}
