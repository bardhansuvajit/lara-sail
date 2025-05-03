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
    // public $editingVariation = null;

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

            $this->loadExistingVariations();

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Success!',
                'message' => 'Variation deleted successfully',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationSend', [
                'variant' => 'danger',
                'title' => 'OOPS!',
                'message' => 'Failed to delete variation: ' . $e->getMessage()
            ]);
        }
    }

    /*
    public function editVariation($variationId)
    {
        $variation = ProductVariation::with(['combinations.attribute', 'combinations.attributeValue'])
        ->findOrFail($variationId);
        $this->editingVariation = $variation->toArray();

        $this->editingVariation['track_quantity'] = (int) ($variation->track_quantity ?? 0);
        $this->editingVariation['allow_backorders'] = (bool)($this->editingVariation['allow_backorders'] ?? false);

        $this->dispatch('open-modal', 'edit-variant');
    }

    public function updateVariation()
    {
        try {
            $variation = ProductVariation::findOrFail($this->editingVariation['id']);

            $validated = $this->validate([
                'editingVariation.variation_identifier' => 'required|string|unique:product_variations,variation_identifier,'.$variation->id,
                'editingVariation.sku' => 'nullable|string|max:50|unique:product_variations,sku,'.$variation->id,
                'editingVariation.barcode' => 'nullable|string|max:50|unique:product_variations,barcode,'.$variation->id,
                'editingVariation.stock_quantity' => 'required|integer|min:0',
                'editingVariation.track_quantity' => 'nullable',
                // 'editingVariation.allow_backorders' => 'nullable',
                'editingVariation.price_adjustment' => 'required|numeric',
                'editingVariation.adjustment_type' => 'required|in:fixed,percentage',

                'editingVariation.weight_adjustment' => 'required|min:0',
                'editingVariation.weight_unit' => 'required|in:g,kg,lb,oz',

                'editingVariation.length_adjustment' => 'required|min:0',
                'editingVariation.width_adjustment' => 'required|min:0',
                'editingVariation.height_adjustment' => 'required|min:0',
                'editingVariation.dimension_unit' => 'required|in:mm,cm,m,in,ft',
            ]);

            dd($validated['editingVariation']['track_quantity']);

            // $validated['editingVariation']['track_quantity'] = (bool)($validated['editingVariation']['track_quantity'] ?? false);
            // $validated['editingVariation']['allow_backorders'] = (bool)($validated['editingVariation']['allow_backorders'] ?? false);

            $variation->update($validated['editingVariation']);

            // $this->dispatch('close-modal', 'edit-variant');
            $this->loadExistingVariations();

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Success!',
                'message' => 'Variation updated successfully',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationSend', [
                'variant' => 'danger',
                'title' => 'OOPS!',
                'message' => $e->getMessage()
            ]);
        }
    }
    */

    public function render()
    {
        return view('livewire.product-variant');
    }
}
