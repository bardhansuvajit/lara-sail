<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductVariationAttribute;

class InputProductVariationAttributeValue extends Component
{
    use WithPagination;

    public ?string $variation_attribute = '';
    public int $attribute_id;
    public ?string $attribute_title;
    protected $listeners = ['setVariationAttribute', 'refreshProducts' => '$refresh'];

    public function mount($attribute_id = '', $attribute_title = '')
    {
        $this->attribute_id = $attribute_id;
        $this->attribute_title = $attribute_title;
    }

    public function setVariationAttribute($id, $title)
    {
        $this->attribute_id = $id;
        $this->attribute_title = $title;
    }

    public function updatedvariation_attribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $variationAttributes = ProductVariationAttribute::when($this->variation_attribute, function ($query) {
            $query->where('title', 'like', '%' . $this->variation_attribute . '%');
        })
        ->where('status', 1)
        ->orderBy('title')
        ->select(['id', 'title'])
        ->simplePaginate(15);

        return view('livewire.input-product-variation-attribute-value', ['variationAttributes' => $variationAttributes]);

    }
}
