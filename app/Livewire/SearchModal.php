<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\ProductFeature;

class SearchModal extends Component
{
    public $query = '';
    public $suggestions = [];
    public $searchResults = [];
    public $categories = [];
    public $showSuggestions = false;
    
    public $sponsoredProducts;

    protected $queryString = ['query'];

    public function mount()
    {
        $this->sponsoredProducts = Cache::remember('search_sponsored_products', now()->addDays(7), function () {
                return ProductFeature::where('type', 'search')
                    ->where('status', 1)
                    ->orderBy('position')
                    ->get();
            });
    }

    public function updatedQuery($value)
    {
        if (strlen($value) >= 2) {
            $this->showSuggestions = true;
            $this->getSearchSuggestions($value);
        } else {
            $this->showSuggestions = false;
            $this->suggestions = [];
        }
    }

    private function getSearchSuggestions($searchTerm)
    {
        // Search across multiple models
        $productResults = Product::where('title', 'like', "%{$searchTerm}%")
            ->with('activeImages')
            ->limit(5)
            ->get();

        $categoryResults = ProductCategory::where('title', 'like', "%{$searchTerm}%")
            ->where('status', 1)
            ->limit(3)
            ->get();

        $collectionResults = ProductCollection::where('title', 'like', "%{$searchTerm}%")
            ->where('status', 1)
            ->limit(3)
            ->get();

        $this->suggestions = [
            'products' => $productResults,
            'categories' => $categoryResults,
            'collections' => $collectionResults,
        ];
    }

    public function performSearch()
    {
        if (empty($this->query)) {
            return;
        }

        // Redirect to search results page or handle inline
        return redirect()->route('front.search.index', ['q' => $this->query]);
    }

    public function selectSuggestion($type, $id, $name = null)
    {
        if ($type === 'product') {
            $product = Product::find($id);
            return redirect()->route('front.product.detail', $product->slug);
        } elseif ($type === 'category') {
            $this->query = $name;
            // Optionally redirect to category page
            // return redirect()->route('front.category.show', $id);
        }
        
        $this->showSuggestions = false;
    }

    public function render()
    {
        return view('livewire.search-modal');
    }
}