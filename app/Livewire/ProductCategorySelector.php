<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class ProductCategorySelector extends Component
{
    public int $level = 1;
    public ?int $parentId = null;
    public $parentOptions = [];

    // livewire constructor
    public function mount()
    {
        $this->updateParentOptions();
    }

    // when user clicks different radio button, this method is triggered
    public function updatedLevel($value)
    {
        dd('here');
        $this->parentId = null;
        $this->updateParentOptions();
    }

    // Update the parent options based on the current level
    protected function updateParentOptions()
    {
        if ($this->level > 1) {
            $this->parentOptions = ProductCategory::where('level', $this->level - 1)->get();
        } else {
            $this->parentOptions = [];
        }
    }

    public function render()
    {
        return view('livewire.product-category-selector');
    }
}
