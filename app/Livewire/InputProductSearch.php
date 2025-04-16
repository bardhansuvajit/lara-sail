<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class InputProductSearch extends Component
{
    use WithPagination;

    public ?string $product = '';
    public int $product_id;
    public ?string $product_title;
    protected $listeners = ['setProduct', 'refreshProducts' => '$refresh'];

    public function mount($product_id = '', $product_title = '')
    {
        $this->product_id = $product_id;
        $this->product_title = $product_title;
    }

    public function setProduct($id, $title)
    {
        $this->product_id = $id;
        $this->product_title = $title;
    }

    public function updatedProduct()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::when($this->product, function ($query) {
            $query->where('title', 'like', '%' . $this->product . '%');
        })
        ->where('status', 1)
        ->orderBy('title')
        ->simplePaginate(15);

        return view('livewire.input-product-search', ['products' => $products]);

    }
}
