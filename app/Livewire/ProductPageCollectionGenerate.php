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
    public ?string $collection_id;
    public ?string $collection_name;

    // default livewire constructor
    public function mount(string $collection = null, $collection_id = '', $collection_name = '')
    {
        $this->collection = '';
        $this->selectedCollections = $collection ? explode(',', $collection) : [];
        $this->collection_id = $collection_id;
        $this->collection_name = $collection_name;
        $this->getCollectionOptions();
    }

    public function updatedCollection()
    {
        $this->getCollectionOptions();
    }

    public function getCollectionOptions()
    {
        $query = ProductCollection::query();
        if ($this->collection) {
            $query->where('title', 'like', "%{$this->collection}%");
        }
        $this->collectionsArrSend = $query->orderBy('position')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.product-page-collection-generate');
    }
}
