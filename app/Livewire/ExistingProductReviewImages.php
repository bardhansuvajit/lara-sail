<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductReviewImageInterface;
use Livewire\Attributes\On;

class ExistingProductReviewImages extends Component
{
    public Collection $images;
    // public int $imageId;
    private ProductReviewImageInterface $productReviewImageRepository;

    public function mount(Collection $images, ProductReviewImageInterface $productReviewImageRepository)
    {
        $this->images = $images;
        $this->productReviewImageRepository = $productReviewImageRepository;
    }

    public function deleteImage(int $imageId)
    {
        $productReviewImageRepository = app(ProductReviewImageInterface::class);
        $resp = $productReviewImageRepository->delete($imageId);
        $this->images = $this->images->reject(fn($image) => $image->id == $imageId);

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Success!',
            'message' => 'Image deleted successfully',
        ]);
    }

    #[On('updateProductImageOrder')]
    public function updateFeatureOrder(array $ids)
    {
        $productReviewImageRepository = app(ProductReviewImageInterface::class);
        $positionResp = $productReviewImageRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
                // 'message' => $this->productTitle . ' is removed'
            ]);

            // Refresh the images collection with the new order
            $this->images = $productReviewImageRepository->list('', ['product_id' => $this->images->first()->product_id], 'all', 'position', 'asc')['data'];

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
        return view('livewire.existing-product-review-images');
    }
}
