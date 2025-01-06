<?php

namespace App\Livewire;

use Livewire\Component;

class QuickDataView extends Component
{
    public $model;
    public $modelId;

    public function viewQuickData() {
        $modelClass = "\\App\\Models\\$this->model";
        $data = $modelClass::find($this->modelId);

        $this->dispatch('open-modal', name: 'quick-data-view');
    }

    public function render()
    {
        return view('livewire.quick-data-view');
    }
}
