<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductStatusInterface;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\CartItemInterface;

class ToggleStatusProduct extends Component
{
    public Int $productId;
    public Int $currentStatus;
    public Collection $allStatus;
    public Int $selectedStatusId;
    private ProductStatusInterface $productStatusRepository;
    private ProductListingInterface $productListingRepository;
    private CartItemInterface $cartItemRepository;

    public function mount(
        $productId,
        $currentStatus,
        ProductStatusInterface $productStatusRepository, 
        ProductListingInterface $productListingRepository, 
        CartItemInterface $cartItemRepository
    )
    {
        $this->productId = $productId;
        $productStatusRepository = app(ProductStatusInterface::class);
        $statusResp = $productStatusRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $this->allStatus = $statusResp['data'];
        $this->selectedStatusId = $currentStatus;
    }

    public function updateStatus()
    {
        if (empty($this->selectedStatusId)) {
            $this->dispatch('notificationSend', [
                'variant' => 'error',
                'title' => 'Error',
                'message' => 'No status selected'
            ]);
            return;
        }

        $productListingRepository = app(ProductListingInterface::class);
        $data = $productListingRepository->getById($this->productId);

        if ($data['code'] != 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'error',
                'title' => 'Error',
                'message' => 'Product not found'
            ]);
            return;
        }

        $product = $data['data'];
        $product->status = $this->selectedStatusId;
        
        if (!$product->save()) {
            $this->dispatch('notificationSend', [
                'variant' => 'error',
                'title' => 'Error',
                'message' => 'Failed to update product status'
            ]);
            return;
        }

        $statusDetail = $product->statusDetail;

        // Update CART if product cannot be ORDERED
        // if ($statusDetail->allow_order != 1) {

            $cartItemRepository = app(CartItemInterface::class);
            $statusResp = $cartItemRepository->updateAvailability([
                'product_id' => $this->productId,
                'is_available' => $statusDetail->allow_order,
                'title_frontend' => $statusDetail->title_frontend,
                'allow_order' => $statusDetail->allow_order,
            ]);
        // }

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Status updated',
            'message' => $product->title . ' is ' . $statusDetail->title
        ]);
    }

    public function render()
    {
        return view('livewire.toggle-status-product');
    }
}
