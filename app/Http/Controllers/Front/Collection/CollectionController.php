<?php

namespace App\Http\Controllers\Front\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductCollectionInterface;

use App\Models\Product;

class CollectionController
{
    private ProductCollectionInterface $productCollectionRepository;

    public function __construct(ProductCollectionInterface $productCollectionRepository)
    {
        $this->productCollectionRepository = $productCollectionRepository;
    }

    public function index(Request $request) : View
    {
        return view('front.collection.index');
    }

    public function detail(Request $request, string $slug): View
    {

        $collection = $this->productCollectionRepository->getBySlug($slug);

        if ($collection['code'] != 200) {
            return redirect()->back();
        }

        // Get products
        $products = Product::whereJsonContains('collection_ids', (int)$collection['data']->id)
            ->where('status', 1)
            ->get();

        return view('front.collection.detail', [
            'collection' => $collection['data'],
            'products' => $products,
        ]);


        /*
        $resp = $this->productCollectionRepository->getBySlug($slug);

        if ($resp['code'] == 200) {
            return view('front.collection.detail', [
                'data' => $resp['data'],
            ]);
        } else {
            return redirect()->back();
        }
        */
    }
}
