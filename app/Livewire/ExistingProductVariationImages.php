<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductImageInterface;
use Livewire\Attributes\On;

class ExistingProductVariationImages extends Component
{
    public Collection $images;
    // public int $imageId;
    private ProductImageInterface $productImageRepository;

    public function mount(Collection $images, ProductImageInterface $productImageRepository)
    {
        $this->images = $images;
        $this->productImageRepository = $productImageRepository;
    }

    public function deleteImage(int $imageId)
    {
        $productImageRepository = app(ProductImageInterface::class);
        $resp = $productImageRepository->delete($imageId);
        $this->images = $this->images->reject(fn($image) => $image->id == $imageId);

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Success!',
            'message' => 'Image deleted successfully',
        ]);
    }

    #[On('updateProductVariationImageOrder')]
    public function updateFeatureOrder(array $ids)
    {
        $productImageRepository = app(ProductImageInterface::class);
        $positionResp = $productImageRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
                // 'message' => $this->productTitle . ' is removed'
            ]);

            // Refresh the images collection with the new order
            $this->images = $productImageRepository->list('', [
                'product_id' => $this->images->first()->product_id,
                'product_variation_id' => $this->images->first()->product_variation_id,
            ], 'all', 'position', 'asc')['data'];

            // $this->images;

            // $this->reloadProducts();
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $positionResp['message'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.existing-product-variation-images');
    }
}
