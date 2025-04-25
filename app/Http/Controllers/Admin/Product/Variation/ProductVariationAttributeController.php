<?php

namespace App\Http\Controllers\Admin\Product\Variation;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductVariationAttributeInterface;

class ProductVariationAttributeController
{
    private ProductVariationAttributeInterface $productVariationAttributeRepository;

    public function __construct(ProductVariationAttributeInterface $productVariationAttributeRepository)
    {
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
        ];
        $resp = $this->productVariationAttributeRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.product.variation.attribute.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.product.variation.attribute.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|min:2|max:255',
            'is_global' => 'required|in:0,1',
            'values' => 'nullable|string|min:2'
        ]);

        $resp = $this->productVariationAttributeRepository->store($request->all());
        return redirect()->route('admin.product.variation.attribute.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->productVariationAttributeRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.product.variation.attribute.edit', [
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
            'title' => 'required|min:2|max:255',
            'is_global' => 'required|in:0,1',
            'values' => 'nullable|string|min:2'
        ]);

        $resp = $this->productVariationAttributeRepository->update($request->all());
        return redirect()->back()->with($resp['status'], $resp['message']);
        // return redirect()->route('admin.product.variation.attribute.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->productVariationAttributeRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->productVariationAttributeRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->productVariationAttributeRepository->import($request->file('file'));
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

        $resp = $this->productVariationAttributeRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->productVariationAttributeRepository->position($request->ids);
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
