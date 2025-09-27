<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductImageInterface;
use Livewire\Attributes\On;

class ExistingProductImages extends Component
{
    public Collection $images;
    public string $type;
    // public int $imageId;
    private ProductImageInterface $productImageRepository;

    public function mount(Collection $images, String $type, ProductImageInterface $productImageRepository)
    {
        $this->images = $images;
        $this->type = $type;
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

    #[On('updateProductImageOrder')]
    public function updateFeatureOrder(array $images)
    {
        $productImageRepository = app(ProductImageInterface::class);
        $positionResp = $productImageRepository->position($images);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
            ]);

            // Refresh the images collection with the new order
            $this->images = $productImageRepository->list('', [
                'product_id' => $this->images->first()->product_id,
                'product_variation_id' => null
            ], 'all', 'position', 'asc')['data'];

            dd($this->images);

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
        return view('livewire.existing-product-images');
    }
}
