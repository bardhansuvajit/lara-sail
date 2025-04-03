<?php

namespace App\Http\Controllers\Admin\Product\Feature;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductFeatureInterface;

class ProductFeatureController
{
    private ProductFeatureInterface $productFeatureRepository;

    public function __construct(ProductFeatureInterface $productFeatureRepository)
    {
        $this->productFeatureRepository = $productFeatureRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,slug',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1'
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $resp = $this->productFeatureRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.product.feature.index', [
            'data' => $resp['data'],
        ]);
    }
}
