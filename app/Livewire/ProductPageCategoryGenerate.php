<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class ProductPageCategoryGenerate extends Component
{
    public ?string $category;
    public array $categories = [];
    public ?int $parentId = null;

    // default livewire constructor
    public function mount($category = null)
    {
        $this->category = $category ?? '';
        $this->getCategoryOptions();
    }

    public function updatedCategory()
    {
        $this->getCategoryOptions();
    }

    public function getCategoryOptions()
    {
        if ($this->category == null) {
            $this->categories = ProductCategory::where('level', 1)->with('childDetails')->orderBy('position')->get()->toArray();
        } else {
            $this->categories = ProductCategory::where('title', 'like', '%'.$this->category.'%')->orderBy('position')->get()->toArray();
        }
    }

    public function getCategoryOptionsByParentId($parentId)
    {
        $this->categories = ProductCategory::where('parent_id', $parentId)->with('childDetails')->orderBy('position')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.product-page-category-generate');
    }
}
