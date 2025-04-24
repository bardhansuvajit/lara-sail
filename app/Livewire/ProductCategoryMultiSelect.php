<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class ProductCategoryMultiSelect extends Component
{
    public string $category = '';
    public array $selectedCategories = [];
    public array $categoriesArrSend = [];
    public ?int $parentId = null;
    public ?string $category_id;
    public ?string $category_name;

    public function mount(string $category = null, $category_id = '', $category_name = '')
    {
        $this->category = '';
        $this->selectedCategories = $category ? explode(',', $category) : [];
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->getCategoryOptions();
    }

    public function updatedCategory()
    {
        $this->getCategoryOptions();
    }

    public function getCategoryOptions()
    {
        $query = ProductCategory::query();
        if ($this->category) {
            $query->where('title', 'like', "%{$this->category}%");
        }
        $this->categoriesArrSend = $query->where('status', 1)->orderBy('position')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.product-category-multi-select');
    }
}
