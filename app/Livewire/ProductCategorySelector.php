<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class ProductCategorySelector extends Component
{
    public ?int $level;
    public ?int $parentId = null;
    public array $parentOptions = [];

    // default livewire constructor
    public function mount($level = null, $parentId = null)
    {
        $this->level = old('level', $level ?? 1);
        $this->parentId = old('parent_id', $parentId);
        $this->updateParentOptions();
    }

    // when user clicks different radio button, this method is triggered
    public function updatedLevel($value)
    {
        $this->parentId = null;
        $this->updateParentOptions();
        $this->dispatch('notificationSend', [
            'variant' => 'info',
            'title' => 'Status updated',
        ]);
    }

    // Update the parent options based on the current level
    protected function updateParentOptions()
    {
        if ($this->level > 1) {
            $this->parentOptions = ProductCategory::where('level', $this->level - 1)->get()->toArray();
        } else {
            $this->parentOptions = [];
        }
    }

    public function render()
    {
        return view('livewire.product-category-selector');
    }
}
