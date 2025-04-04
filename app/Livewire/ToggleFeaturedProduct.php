<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductFeature;

class ToggleFeaturedProduct extends Component
{
    public $featureId;
    public $status;

    public function mount($featureId)
    {
        $data = ProductFeature::find($this->featureId);
        $this->status = $data ? $data->status : 0;
    }

    public function toggle()
    {
        $data = ProductFeature::find($this->featureId);

        dd($data);

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
        return view('livewire.toggle-featured-product');
    }
}
