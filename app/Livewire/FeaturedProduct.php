<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\ProductFeatureInterface;

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
        $featuredProducts = $this->productFeatureRepository->list('', [], 'all', 'position', 'asc');

        $this->featuredProducts = collect($featuredProducts['data']);
    }

    public function render()
    {
        return view('livewire.featured-product');
    }
}
