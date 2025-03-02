<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCollection;

class ProductPageCollectionGenerate extends Component
{
    // public array $collection = [];
    public string $collection = '';
    public array $selectedCollections = [];
    public array $collectionsArrSend = [];
    public ?int $parentId = null;

    // default livewire constructor
    public function mount(string $collection = null)
    {
        $this->collection = '';
        $this->selectedCollections = $collection ? explode(',', $collection) : [];
        $this->getCollectionOptions();
    }

    public function updatedCollection()
    {
        $this->getCollectionOptions();
    }

    public function getCollectionOptions()
    {
        $this->collectionsArrSend = ProductCollection::where('title', 'like', '%'.$this->collection.'%')
                        ->orderBy('position')
                        ->get()
                        ->toArray();
    }

    public function render()
    {
        return view('livewire.product-page-collection-generate');
    }
}
