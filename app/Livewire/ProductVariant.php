<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\ProductCategoryVariationAttributeInterface;

class ProductVariant extends Component
{
    public int $product_id; 
    public int $category_id;
    public Collection $variations;
    private ProductCategoryVariationAttributeInterface $productCategoryVariationAttributeRepository;

    public function mount($product_id, $category_id, ProductCategoryVariationAttributeInterface $productCategoryVariationAttributeRepository)
    {
        $this->product_id = $product_id;
        $this->category_id = $category_id;
        $this->categoryVariationFetch();
    }

    public function categoryVariationFetch()
    {
        $productCategoryVariationAttributeRepository = app(ProductCategoryVariationAttributeInterface::class);
        $existingAttributeValues = $productCategoryVariationAttributeRepository->exists([
            'category_id' => $this->category_id,
            'status' => 1
        ]);

        $this->variations = $existingAttributeValues['data'];
    }

    public function render()
    {
        return view('livewire.product-variant');
    }
}
