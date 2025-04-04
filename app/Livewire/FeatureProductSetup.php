<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\ProductFeature;

class FeatureProductSetup extends Component
{
    public collection $features;

    public function mount()
    {
        $this->features = ProductFeature::orderBy('position')->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.feature-product-setup');
    }
}
