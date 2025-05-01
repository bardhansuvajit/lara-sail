<?php

namespace App\Http\Controllers\Admin\Product\Variation;

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

    public function delete(Int $id)
    {
        $resp = $this->productVariationRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
