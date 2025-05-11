<?php

namespace App\Http\Controllers\Api\Product\Variation;

use Illuminate\Http\Request;
use Illuminate\View\View;
// use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductVariationCombinationInterface;

class ProductVariationCombinationController
{
    private ProductVariationCombinationInterface $productVariationCombinationRepository;

    public function __construct(ProductVariationCombinationInterface $productVariationCombinationRepository)
    {
        $this->productVariationCombinationRepository = $productVariationCombinationRepository;
    }

    public function check(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'productId' => 'required|integer|min:1|exists:products,id',
            'attrId' => 'required|integer|min:1|exists:product_variation_attributes,id',
            'valueId' => 'required|integer|min:1|exists:product_variation_attribute_values,id'
        ]);

        $resp = $this->productVariationCombinationRepository->combination([
            'productId' => $request->productId,
            'attrId' => $request->attrId,
            'valueId' => $request->valueId
        ]);
        return $resp;
    }
}
