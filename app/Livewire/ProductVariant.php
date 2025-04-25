<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductVariationAttribute;

class ProductVariant extends Component
{
    public int $product_id; 
    public int $category_id;
    public $variations;

    public function mount(
        $product_id, 
        $category_id
    )
    {
        $this->product_id = $product_id;
        $this->category_id = $category_id;
        $this->loadVariations();
    }

    public function loadVariations()
    {
        // $query = ProductVariationAttribute::query();
        // $query->where(function ($query) use ($keyword) {
        //     $query->where('status', 1);
        // });
        // $data = $query->orderBy('position', 'asc')->with('values.categories')->get();

        $this->variations = ProductVariationAttribute::query()
            ->where('status', 1)
            ->where(function($query) {
                $query->where(function($q) {
                        $q->where('is_global', 1)
                          ->whereHas('values');
                    })
                    ->orWhere(function($q) {
                        $q->where('is_global', 0)
                          ->whereHas('values.categories', fn($q) => $q->where('category_id', $this->category_id));
                    });
            })
            ->with(['values' => function($query) {
                $query->where('status', 1)
                      ->where(function($q) {
                          $q->whereHas('categories', fn($q) => $q->where('category_id', $this->category_id))
                            ->orWhereHas('attribute', fn($q) => $q->where('is_global', 1));
                      })
                      ->with('categories'); // Eager load categories if needed
            }])
            ->orderBy('position', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.product-variant');
    }
}
