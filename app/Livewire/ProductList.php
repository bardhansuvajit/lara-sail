<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductFeatureInterface;
use Livewire\Attributes\On;

class ProductList extends Component
{
    use WithPagination;

    public array $featureTypes = [];
    public string $keyword = '';
    public string $status = '';
    public string $sortBy = 'title';
    public string $sortOrder = 'asc';
    public $perPage = 15;

    private ProductListingInterface $productListingRepository;
    private ProductFeatureInterface $productFeatureRepository;

    public function boot(
        ProductListingInterface $productListingRepository,
        ProductFeatureInterface $productFeatureRepository
    ) {
        $this->productListingRepository = $productListingRepository;
        $this->productFeatureRepository = $productFeatureRepository;
    }

    public function search()
    {
        $this->resetPage(); // ensure page resets when searching
    }

    public function resetFilters()
    {
        $this->reset(['keyword', 'status', 'sortBy', 'sortOrder', 'perPage']);
        $this->resetPage();
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['keyword', 'status', 'sortBy', 'sortOrder', 'perPage'])) {
            $this->resetPage();
        }
    }

    #[On('updateProductListAction')]
    public function updateActionButtons()
    {
        // reset all radios
        foreach ($this->featureTypes as $id => $type) {
            $this->featureTypes[$id] = 'off';
        }
    }

    /** ✅ New method for feature toggle */
    public function updateFeatureType(int $productId, string $productTitle, string $value)
    {
        $data = $this->productFeatureRepository->getByProductId($productId);

        // Already Featured
        if ($data['code'] == 200 && !empty($data['data'])) {
            if ($value === 'off') {
                // Load Featured Products
                $this->dispatch('afterDeleteLoadFeaturedProducts', id: $data['data']['id']);
                // $this->productFeatureRepository->delete($data['data']['id']);

                $this->dispatch('notificationSend', [
                    'variant' => 'success',
                    'message' => "{$productTitle} removed from features"
                ]);

                return;
            }

            // If NOT Same Feature Value
            if ($data['data']->type != $value) {
                // Load Featured Products
                $this->dispatch('productEnabled');

                $this->productFeatureRepository->update($data['data']['id'], [
                    'type' => $value
                ]);

                $this->dispatch('notificationSend', [
                    'variant' => 'success',
                    // 'title' => 'Status updated',
                    'message' => "{$productTitle} updated to {$value}"
                ]);
            }

        }
        // Not yet Featured
        else {
            if ($value === 'off') {
                $this->dispatch('notificationSend', [
                    'variant' => 'warning',
                    // 'title' => 'OOPS!',
                    'message' => "This action cannot be performed!"
                ]);
                return;
            }

            // Load Featured Products
            $this->dispatch('productEnabled');

            $this->productFeatureRepository->store([
                'product_id' => $productId,
                'type' => $value
            ]);

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                // 'title' => 'Status updated',
                'message' => "{$productTitle} added as {$value}"
            ]);
        }
    }

    public function render()
    {
        $filters = ['status' => $this->status];

        $resp = $this->productListingRepository->list(
            $this->keyword,
            $filters,
            $this->perPage,
            $this->sortBy,
            $this->sortOrder
        );

        $products = $resp['data'];

        // sync featureTypes with DB on each render
        foreach ($products as $item) {
            $this->featureTypes[$item->id] = $item->featured->type ?? 'off';
        }

        return view('livewire.product-list', compact('products'));
    }
}
