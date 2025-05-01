<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductVariationAttribute;
use App\Models\ProductVariation;

class ProductVariant extends Component
{
    public int $product_id; 
    public int $category_id;
    public $variations;
    public string $search = '';
    public $existingVariations = [];
    protected $listeners = ['variation-added' => 'loadExistingVariations'];

    public function mount($product_id, $category_id)
    {
        $this->product_id = $product_id;
        $this->category_id = $category_id;
        $this->loadVariations();
        $this->loadExistingVariations();
    }

    public function updatedSearch()
    {
        $this->loadVariations();
    }

    public function loadVariations()
    {
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
                        ->when($this->search, function($q) {
                            $q->where('title', 'like', '%'.$this->search.'%');
                        })
                        ->with('categories'); // Eager load categories
            }])
            ->orderBy('position', 'asc')
            ->get();
    }

    public function loadExistingVariations()
    {
        /*
        $variations = ProductVariation::with(['combinations.attribute', 'combinations.attributeValue'])
            ->where('product_id', $this->product_id)
            ->get()
            ->map(function ($variation) {
                return $variation->combinations->map(function ($combo) {
                    return [
                        'attribute_id' => $combo->attribute_id,
                        'attribute_title' => $combo->attribute->title,
                        'value_id' => $combo->attribute_value_id,
                        'value_title' => $combo->attributeValue->title,
                    ];
                });
            })
            ->collapse() // Flatten all combinations from all variations
            ->groupBy('attribute_title') // Group by attribute name
            ->map(function ($group) {
                // Get unique values for each attribute
                return $group->unique('value_id')
                    ->pluck('value_title')
                    ->sort()
                    ->values()
                    ->toArray();
            });

            $this->existingVariations = $variations->all();
        */

        $rawVariations = ProductVariation::with(['combinations.attribute', 'combinations.attributeValue'])
            ->where('product_id', $this->product_id)
            ->get()
            ->map(function ($variation) {
                return [
                    'id' => $variation->id,
                    'combinations' => $variation->combinations->map(function ($combo) {
                        return [
                            'attribute_id' => $combo->attribute_id,
                            'attribute_title' => $combo->attribute->title,
                            'value_id' => $combo->attribute_value_id,
                            'value_title' => $combo->attributeValue->title,
                        ];
                    }),
                    'variation_identifier' => $variation->variation_identifier,
                    'sku' => $variation->sku,
                    'barcode' => $variation->barcode,
                    'stock_quantity' => $variation->stock_quantity,
                    'track_quantity' => $variation->track_quantity,
                    'allow_backorders' => $variation->allow_backorders,
                    'price_adjustment' => $variation->price_adjustment,
                    'adjustment_type' => $variation->adjustment_type,
                    'barcode' => $variation->barcode,
                    'barcode' => $variation->barcode,
                    'created_at' => $variation->created_at->format('M d, Y'),
                ];
            });

        // Grouped data
        $grouped = collect($rawVariations)
            ->pluck('combinations')
            ->collapse()
            ->groupBy('attribute_title')
            ->map(function ($group) {
                return $group->unique('value_id')
                    ->pluck('value_title')
                    ->sort()
                    ->values()
                    ->toArray();
            });

        $this->existingVariations = [
            'raw' => $rawVariations,
            'grouped' => $grouped
        ];

        $this->dispatch('variations-updated');

        // dd($this->existingVariations);
    }

    public function deleteVariation($variationId)
    {
        try {
            $variation = ProductVariation::findOrFail($variationId);
            $variation->delete();
            
            // Reload the existing variations
            $this->loadExistingVariations();
            
            // Show success notification
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Variation deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to delete variation: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.product-variant');
    }
}
