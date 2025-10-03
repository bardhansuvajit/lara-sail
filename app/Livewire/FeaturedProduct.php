<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\ProductFeatureInterface;
use Illuminate\Support\Facades\Cache;

class FeaturedProduct extends Component
{
    public Collection $featuredProducts;
    private ProductFeatureInterface $productFeatureRepository;

    public function mount(ProductFeatureInterface $productFeatureRepository)
    {
        $this->productFeatureRepository = $productFeatureRepository;
        $this->getData();
    }

    public function getData(): void
    {
        $productFeatures = $this->productFeatureRepository->listAllFeatured();
        $featuredProducts = $productFeatures['data']['featured'] ?? [];

        $this->featuredProducts = collect($featuredProducts);
    }

    public function render()
    {
        return view('livewire.featured-product');
    }
}
