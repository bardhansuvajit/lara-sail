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
    public $selectedIndex = -1;

    public $sponsoredProducts;

    // protected $queryString = ['q' => ['except' => '']];
    // protected $queryString = ['query' => ['except' => '']];

    public function mount()
    {
        // Initialize query from request
        $this->query = request()->input('q', '');

        $this->sponsoredProducts = Cache::remember('search_sponsored_products', now()->addDays(7), function () {
            return ProductFeature::where('type', 'search')
                ->where('status', 1)
                ->orderBy('position')
                ->get();
        });
    }

    public function updatedQuery($value)
    {
        if (strlen($value) >= 1) {
            $this->showSuggestions = true;
            $this->getSearchSuggestions($value);
        } else {
            $this->showSuggestions = false;
            $this->suggestions = [];
        }
        $this->selectedIndex = -1; // Reset selection when query changes
    }

    private function getSearchSuggestions($searchTerm)
    {
        // Search across multiple models
        $productResults = Product::where('title', 'like', "%{$searchTerm}%")
            ->orWhere('search_tags', 'like', "%{$searchTerm}%")
            ->with('activeImages', 'statusDetail')
            ->whereHas('statusDetail', function ($q) {
                $q->where('show_in_frontend', 1);
            })
            ->limit(5)
            ->get();

        $categoryResults = ProductCategory::where('title', 'like', "%{$searchTerm}%")
            ->orWhere('tags', 'like', "%{$searchTerm}%")
            ->where('status', 1)
            ->limit(3)
            ->get();

        $collectionResults = ProductCollection::where('title', 'like', "%{$searchTerm}%")
            ->orWhere('tags', 'like', "%{$searchTerm}%")
            ->where('status', 1)
            ->limit(3)
            ->get();

        $this->suggestions = [
            'products' => $productResults,
            'categories' => $categoryResults,
            'collections' => $collectionResults,
        ];
    }

    public function getTotalSuggestions()
    {
        return count($this->suggestions['products']) + 
               count($this->suggestions['categories']) + 
               count($this->suggestions['collections']);
    }

    public function getAllSuggestionsFlat()
    {
        $allSuggestions = [];
        
        foreach ($this->suggestions['products'] as $product) {
            $allSuggestions[] = ['type' => 'product', 'item' => $product];
        }
        
        foreach ($this->suggestions['categories'] as $category) {
            $allSuggestions[] = ['type' => 'category', 'item' => $category];
        }
        
        foreach ($this->suggestions['collections'] as $collection) {
            $allSuggestions[] = ['type' => 'collection', 'item' => $collection];
        }
        
        return $allSuggestions;
    }

    public function selectSuggestion($type, $id, $slug = null)
    {
        if ($type === 'product' && $slug) {
            return redirect()->route('front.product.detail', $slug);
        } elseif ($type === 'category' && $slug) {
            return redirect()->route('front.category.detail', $slug);
        } elseif ($type === 'collection' && $slug) {
            // Adjust route according to your application
            return redirect()->route('front.collection.detail', $slug);
        }
        
        $this->showSuggestions = false;
        $this->selectedIndex = -1;
    }

    public function selectCurrentSuggestion()
    {
        $allSuggestions = $this->getAllSuggestionsFlat();
        
        if (isset($allSuggestions[$this->selectedIndex])) {
            $suggestion = $allSuggestions[$this->selectedIndex];
            $this->selectSuggestion(
                $suggestion['type'], 
                $suggestion['item']->id, 
                $suggestion['item']->slug ?? $suggestion['item']->slug
            );
        }
    }

    public function moveSelection($direction)
    {
        $totalSuggestions = $this->getTotalSuggestions();
        
        if ($direction === 'up') {
            $this->selectedIndex = $this->selectedIndex <= 0 ? $totalSuggestions - 1 : $this->selectedIndex - 1;
        } elseif ($direction === 'down') {
            $this->selectedIndex = $this->selectedIndex >= $totalSuggestions - 1 ? 0 : $this->selectedIndex + 1;
        }
    }

    public function performSearch()
    {
        if (empty($this->query)) {
            return;
        }

        return redirect()->route('front.search.index', ['q' => $this->query]);
    }

    public function render()
    {
        return view('livewire.search-modal');
    }
}