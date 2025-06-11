<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductStatusInterface;

class ToggleStatusProduct extends Component
{
    public Int $productId;
    public Int $currentStatus;
    public Collection $allStatus;
    private ProductStatusInterface $productStatusRepository;

    public function mount(
        $productId,
        $currentStatus,
        ProductStatusInterface $productStatusRepository
    )
    {
        // $modelClass = "\\App\\Models\\$this->model";
        // $data = $modelClass::find($this->productId);
        // $this->status = $data ? $data->status : 0;

        $productStatusRepository = app(ProductStatusInterface::class);
        $statusResp = $productStatusRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $this->productId = $productId;
        $this->allStatus = $statusResp['data'];
    }

    public function updateStatus()
    {
        $data = Product::find($this->productId);

        if(!empty($data)) {
            $data->status = ($data->status == 0) ? 1 : 0;
            $data->save();

            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Status updated',
                'message' => $data->title . ' is ' . (($data->status == 0) ? 'disabled' : 'active')
            ]);
        }
    }

    public function render()
    {
        return view('livewire.toggle-status-product');
    }
}
