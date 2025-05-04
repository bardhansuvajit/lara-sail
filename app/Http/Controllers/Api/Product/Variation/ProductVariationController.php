<?php

namespace App\Http\Controllers\Api\Product\Variation;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductVariationInterface;

class ProductVariationController
{
    private ProductVariationInterface $productVariationRepository;

    public function __construct(ProductVariationInterface $productVariationRepository)
    {
        $this->productVariationRepository = $productVariationRepository;
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_id' => 'required|integer|min:1|exists:products,id',
            'variations' => 'required|array'
        ]);

        // $resp = $this->productVariationRepository->store($request->all());
        $resp = $this->productVariationRepository->store([
            'product_id' => $request->product_id,
            'variations' => $request->variations,
            'sku' => $request->sku ?? null,
            'barcode' => $request->barcode ?? null,
            'track_quantity' => $request->stock_quantity > 0 ? 1 : 0,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'allow_backorders' => $request->allow_backorders,
            'sold_count' => $request->sold_count ?? 0,
            'in_cart_count' => $request->in_cart_count ?? 0,
            'primary_image_id' => $request->primary_image_id ?? null,
            'price_adjustment' => $request->price_adjustment ?? 0,
            'adjustment_type' => $request->adjustment_type ?? 'fixed',
            'weight_adjustment' => $request->weight_adjustment ?? 0,
            'height_adjustment' => $request->height_adjustment ?? 0,
            'width_adjustment' => $request->width_adjustment ?? 0,
            'length_adjustment' => $request->length_adjustment ?? 0,
            'weight_unit' => $request->weight_unit ?? 'g',
            'dimension_unit' => $request->dimension_unit ?? 'cm',
            'is_default' => $request->is_default ?? 0,
            'status' => $request->status ?? 0
        ]);
        return $resp;
    }
}
