<?php

namespace App\Http\Controllers\Admin\Product\Variation;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductVariationAttributeInterface;
use App\Interfaces\ProductVariationAttributeValueInterface;

class ProductVariationAttributeValueController
{
    private ProductVariationAttributeValueInterface $productVariationAttributeValueRepository;
    private ProductVariationAttributeInterface $productVariationAttributeRepository;

    public function __construct(ProductVariationAttributeValueInterface $productVariationAttributeValueRepository, ProductVariationAttributeInterface $productVariationAttributeRepository)
    {
        $this->productVariationAttributeValueRepository = $productVariationAttributeValueRepository;
        $this->productVariationAttributeRepository = $productVariationAttributeRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,position',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1',
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
            'attribute_id' => $request->input('attributeId', ''),
        ];
        $resp = $this->productVariationAttributeValueRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.product.variation.attribute-value.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        // $variationAttributes = $this->productVariationAttributeRepository->list('', ['status' => 1], 'all', 'title', 'asc')['data'];
        // return view('admin.product.variation.attribute-value.create', [
        //     'variationAttributes' => $variationAttributes
        // ]);

        if (request()->input('attributeId')) {
            $variationAttributeData = $this->productVariationAttributeRepository->getById(request()->input('attributeId'));

            if ($variationAttributeData['code'] == 200) {
                return view('admin.product.variation.attribute-value.create', [
                    'variationAttrTitle' => $variationAttributeData['data']->title
                ]);
            }
        }

        return view('admin.product.variation.attribute-value.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'attribute_id' => 'required|integer|min:1|exists:product_variation_attributes,id',
            'title' => 'required|string|min:1|max:255',
            'category_id' => 'required|regex:/^\d+(,\d+)*$/', // regex for comma separated numbers
            'category_name' => 'required|string|min:2',
            'type' => 'nullable|integer|min:1',
            'short_description' => 'nullable|string|min:2|max:1000',
            'long_description' => 'nullable|string|min:2',
            'tags' => 'nullable|string|min:1',
        ]);

        $resp = $this->productVariationAttributeValueRepository->store($request->all());
        return redirect()
            ->route('admin.product.variation.attribute.value.index', request()->query())
            ->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->productVariationAttributeValueRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.product.variation.attribute-value.edit', [
                'data' => $resp['data'],
            ]);
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer|min:1',
            'attribute_id' => 'required|integer|min:1|exists:product_variation_attributes,id',
            'title' => 'required|string|min:1|max:255',
            'category_id' => 'required|regex:/^\d+(,\d+)*$/', // regex for comma separated numbers
            'category_name' => 'required|string|min:2',
            'type' => 'nullable|integer|min:1',
            'short_description' => 'nullable|string|min:2|max:1000',
            'long_description' => 'nullable|string|min:2',
            'tags' => 'nullable|string|min:1',
        ]);

        $resp = $this->productVariationAttributeValueRepository->update($request->all());
        return redirect()
            ->back()
            // ->route('admin.product.variation.attribute.value.index', request()->query())
            ->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->productVariationAttributeValueRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->productVariationAttributeValueRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->productVariationAttributeValueRepository->import($request->file('file'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function export(Request $request, String $type)
    {
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

        $resp = $this->productVariationAttributeValueRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->productVariationAttributeValueRepository->position($request->ids);
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
