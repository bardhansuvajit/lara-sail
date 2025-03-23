<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductImageInterface;

class ExistingProductImages extends Component
{
    public Collection $images;
    public String $type;
    public int $imageId;
    private ProductImageInterface $productImageRepository;

    public function mount(Collection $images, String $type, ProductImageInterface $productImageRepository)
    {
        $this->images = $images;
        $this->type = $type;
        $this->productImageRepository = $productImageRepository;
    }

    public function deleteImage($imageId)
    {
        $productImageRepository = app(ProductImageInterface::class);
        $resp = $productImageRepository->delete($imageId);
        $this->images = $this->images->reject(fn($image) => $image->id == $imageId);
    }

    public function render()
    {
        return view('livewire.existing-product-images');
    }
}
