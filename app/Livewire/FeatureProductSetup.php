<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\ProductFeature;

class FeatureProductSetup extends Component
{
    public collection $featuredProducts;

    public function mount()
    {
        $this->featuredProducts = ProductFeature::orderBy('position')->get();
    }

    public function render()
    {
        return view('livewire.feature-product-setup');
    }
}
