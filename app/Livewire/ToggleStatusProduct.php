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
        $productStatusRepository = app(ProductStatusInterface::class);
        $statusResp = $productStatusRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $this->productId = $productId;
        $this->allStatus = $statusResp['data'];
        $this->selectedStatusId = $currentStatus;
    }

    public function updateStatus()
    {
        $productListingRepository = app(ProductListingInterface::class);
        $data = $productListingRepository->getById($this->productId);

        if($data['code'] == 200) {
            $product = $data['data'];
            $product->status = $this->selectedStatusId;
            $product->save();

            $statusDetail = $product->statusDetail;

            // Update CART if product cannot be ORDERED
            if ($statusDetail->allow_order != 1) {

                $cartItemRepository = app(CartItemInterface::class);
                $statusResp = $cartItemRepository->updateAvailability([
                    'product_id' => $this->productId,
                    'is_available' => 0,
                    'availability_message' => $statusDetail->availability_message,
                    'updated_at' => now()
                ]);
            }

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Status updated',
                'message' => $product->title . ' is ' . $statusDetail->title
            ]);
        }
    }

    public function render()
    {
        return view('livewire.toggle-status-product');
    }
}
