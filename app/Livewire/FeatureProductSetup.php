<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\ProductFeatureInterface;
use Livewire\Attributes\On;

class FeatureProductSetup extends Component
{
    public collection $featuredProducts;
    protected $listeners = ['somethingUpdated' => 'reloadData'];
    private ProductFeatureInterface $productFeatureRepository;

    public function mount(ProductFeatureInterface $productFeatureRepository)
    {
        $this->reloadProducts();
    }

    #[On('productEnabled')]
    public function reloadProducts()
    {
        $productFeatureRepository = app(ProductFeatureInterface::class);
        $resp = $productFeatureRepository->list('', ['type' => 'featured'], 'all', 'position', 'asc')['data'];
        $this->featuredProducts = collect($resp);
    }

    #[On('updateProductFeatureOrder')]
    public function updateFeatureOrder(array $ids)
    {
        $productFeatureRepository = app(ProductFeatureInterface::class);
        $positionResp = $productFeatureRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
            ]);

            $this->reloadProducts();
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $positionResp['message'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.feature-product-setup');
    }
}
