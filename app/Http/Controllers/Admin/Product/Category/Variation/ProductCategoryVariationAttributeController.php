<?php

namespace App\Http\Controllers\Admin\Product\Category\Variation;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductCategoryVariationAttributeInterface;

class ProductCategoryVariationAttributeController
{
    private ProductCategoryVariationAttributeInterface $productCategoryVariationAttributeRepository;

    public function __construct(ProductCategoryVariationAttributeInterface $productCategoryVariationAttributeRepository)
    {
        $this->productCategoryVariationAttributeRepository = $productCategoryVariationAttributeRepository;
    }

    public function toggle(Request $request, $categoryId, $attrValueId)
    {
        // dd($categoryId, $attrValueId);

        $exists = $this->productCategoryVariationAttributeRepository->exists([
            'category_id' => $categoryId,
            'attribute_value_id' => $attrValueId,
        ]);

        if ($exists['code'] === 200) {
            $data = $exists['data'];
            $resp = $this->productCategoryVariationAttributeRepository->delete($data[0]->id);
        } else {
            $resp = $this->productCategoryVariationAttributeRepository->store([
                'category_id' => $categoryId,
                'attribute_value_id' => $attrValueId
            ]);
        }

        return redirect()->back()->with($resp['status'], $resp['message']);
    }

}
