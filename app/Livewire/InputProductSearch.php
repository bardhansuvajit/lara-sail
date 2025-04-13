<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
// use App\Interfaces\ProductListingInterface;

class InputProductSearch extends Component
{
    use WithPagination;

    // used for search
    public ?string $product = '';
    // to send data
    // public array $products = [];
    // public ?int $parentId = null;
    // coming from blade file
    public int $product_id;
    // coming from blade file
    public ?string $product_title;
    // listener from liwewire blade, used to update values
    // protected $listeners = ['setProduct'];
    protected $listeners = ['setProduct', 'refreshProducts' => '$refresh'];
    // interface to fetch data
    // private ProductListingInterface $productListingRepository;

    // default livewire constructor
    public function mount($product_id = '', $product_title = '')
    {
        // $this->product = $product ?? '';
        $this->product_id = $product_id;
        $this->product_title = $product_title;
        // $this->getProducts();
    }

    public function setProduct($id, $title)
    {
        $this->product_id = $id;
        $this->product_title = $title;
    }

    public function updatedProduct()
    {
        $this->resetPage(); // Reset pagination when searching
    }

    // public function getProducts()
    // {
    //     $this->products = Product::orderBy('title')->simplePaginate(1)->items();

    //     // if ($this->product == null) {
    //     //     $this->products = Product::orderBy('title')->limit('15')->get()->toArray();
    //     // } else {
    //     //     $this->products = Product::where('title', 'like', '%'.$this->product.'%')->get()->toArray();
    //     // }
    // }

    public function render()
    {
        $products = Product::when($this->product, function ($query) {
            $query->where('title', 'like', '%' . $this->product . '%');
        })
        ->orderBy('title')
        ->simplePaginate(1); // Adjust pagination limit here

        // return view('livewire.input-product-search', compact('products'));
        return view('livewire.input-product-search', ['products' => $products]);

    }
}
