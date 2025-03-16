<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class ProductPageCategoryGenerate extends Component
{
    public ?string $category;
    public array $categories = [];
    public ?int $parentId = null;
    public int $category_id;
    public ?string $category_name;

    // default livewire constructor
    public function mount($category = null, $category_id = '', $category_name = '')
    {
        $this->category = $category ?? '';
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->getCategoryOptions();
    }

    public function setCategory($id, $title)
    {
        $this->category_id = $id;
        $this->category_name = $title;
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
        $this->categories = ProductCategory::where('parent_id', $parentId)
            ->with(['childDetails' => fn($q) => $q->select('id', 'parent_id', 'title')])
            ->select(['id', 'parent_id', 'title', 'image_s', 'level'])
            ->orderBy('position')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.product-page-category-generate');
    }
}
