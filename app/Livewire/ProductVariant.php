<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductVariationAttribute;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ProductVariation;
use Livewire\Attributes\On;
use App\Interfaces\ProductVariationInterface;
use App\Interfaces\ProductStatusInterface;

class ProductVariant extends Component
{
    public int $product_id; 
    public int $category_id;
    public $variations;
    public string $search = '';
    public string $sortBy = 'position';
    public string $sortOrder = 'asc';
    private ProductVariationInterface $productVariationRepository;
    public $existingVariations = [];

    // public $selectedVariationId;
    // public $selectedStatusId;
    public Collection $allStatus;
    private ProductStatusInterface $productStatusRepository;

    protected $listeners = [
        'variation-added' => 'onVariationAdded'
    ];

    public function mount(
        $product_id,
        $category_id,
        ProductVariationInterface $productVariationRepository,
        ProductStatusInterface $productStatusRepository
    )
    {
        $this->product_id = $product_id;
        $this->category_id = $category_id;
        
        // Assign to class properties
        $this->productVariationRepository = $productVariationRepository;
        $this->productStatusRepository = $productStatusRepository;
        
        $this->loadVariations();
        $this->loadExistingVariations();

        // Use the injected repository directly
        $statusResp = $this->productStatusRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $this->allStatus = $statusResp['data'];
    }

    public function updatedSearch()
    {
        $this->loadVariations();
    }

    public function updatedSortBy()
    {
        $this->loadVariations();
    }

    public function updatedSortOrder()
    {
        $this->loadVariations();
    }

    public function loadVariations()
    {
        \DB::enableQueryLog();

        $this->variations = ProductVariationAttribute::query()
            ->where('status', 1)
            ->where(function($query) {
                $query->where(function($q) {
                        $q->where('is_global', 1)
                          ->whereHas('valuesUnsorted');
                    })
                    ->orWhere(function($q) {
                        $q->where('is_global', 0)
                          ->whereHas('valuesUnsorted.categories', fn($q) => $q->where('category_id', $this->category_id));
                    });
            })
            ->with(['valuesUnsorted' => function($query) {
                $query->where('status', 1)
                        ->where(function($q) {
                            $q->whereHas('categories', fn($q) => $q->where('category_id', $this->category_id))
                                ->orWhereHas('attribute', fn($q) => $q->where('is_global', 1));
                        })
                        ->when($this->search, function($q) {
                            $q->where('title', 'like', '%'.$this->search.'%');
                        })
                        ->with('categories') // Eager load categories
                        ->orderBy($this->sortBy, $this->sortOrder);
            }])
            // ->orderBy($this->sortBy, $this->sortOrder)
            ->orderBy('position', 'asc')
            ->get();

        // dd(\DB::getQueryLog());

        // dd($this->variations);
    }

    public function loadExistingVariations()
    {
        $rawVariations = ProductVariation::with(['combinations.attribute', 'combinations.attributeValue', 'images'])
            ->where('product_id', $this->product_id)
            ->orderBy('position', 'asc')
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
                    'images' => $variation->images,
                    'variation_identifier' => $variation->variation_identifier,
                    'sku' => $variation->sku,
                    'barcode' => $variation->barcode,
                    'stock_quantity' => $variation->stock_quantity,
                    'track_quantity' => $variation->track_quantity,
                    'allow_backorders' => $variation->allow_backorders,
                    'price_adjustment' => $variation->price_adjustment,
                    'adjustment_type' => $variation->adjustment_type,
                    'pricings' => $variation->pricings,
                    'status' => $variation->status,
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

        // dd($this->existingVariations);

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

    public function onVariationAdded()
    {
        $this->loadExistingVariations();
        $this->loadVariations(); // refresh filtered variations
    }

    #[On('updateProductVariantsOrder')]
    public function updateFeatureOrder(array $ids)
    {
        $productVariationRepository = app(ProductVariationInterface::class);
        $positionResp = $productVariationRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
                // 'message' => $this->productTitle . ' is removed'
            ]);

            $this->loadExistingVariations();

            // Refresh the images collection with the new order
            // $this->images = $productVariationRepository->list('', ['product_id' => $this->images->first()->product_id], 'all', 'position', 'asc')['data'];

            // $this->images;

            // $this->reloadProducts();
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $positionResp['message'],
            ]);
        }
    }

    public function updateVariationStatus()
    {
        if (empty($this->selectedVariationId)) {
            $this->dispatch('notificationSend', [
                'variant' => 'error',
                'title' => 'Error',
                'message' => 'No variation selected'
            ]);
            return;
        }

        try {
            $variation = ProductVariation::findOrFail($this->selectedVariationId);
            $variation->status = $this->selectedStatusId;
            $variation->save();

            // Reload the variations to reflect the change
            $this->loadExistingVariations();

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Success!',
                'message' => 'Variation status updated successfully',
            ]);

            // Reset the selected values
            $this->selectedVariationId = null;
            $this->selectedStatusId = null;

        } catch (\Exception $e) {
            $this->dispatch('notificationSend', [
                'variant' => 'danger',
                'title' => 'OOPS!',
                'message' => 'Failed to update variation status: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.product-variant');
    }
}
