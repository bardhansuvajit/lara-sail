<?php

namespace App\Http\Controllers\Admin\Product\Category;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductCategoryInterface;

class ProductCategoryController
{
    private $productCategory;

    public function __construct(ProductCategoryInterface $productCategoryInterface)
    {
        $this->productCategoryInterface = $productCategoryInterface;
    }

    public function index(Request $request): View
    {
        // return view('admin.product.category.index');

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|min:1',
            'sortBy' => 'nullable|string|in:id,title,slug',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1'
        ]);

        $perPage = 15;
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $resp = $this->productCategoryInterface->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.product.category.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.product.category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'image' => 'nullable|image|max:1000',
            'title' => 'required|min:2|max:255',
            'level' => 'required|in:1,2,3,4',
            'parent_id' => 'nullable',
        ]);

        $resp = $this->productCategoryInterface->store($request->all());
        return redirect()->route('admin.product.category.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View
    {
        $resp = $this->productCategoryInterface->getById($id);
        return view('admin.product.category.edit', [
            'data' => $resp['data'],
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer',
            'image' => 'nullable|image|max:1000',
            'title' => 'required|min:2|max:255',
            'level' => 'required|in:1,2,3,4',
            'parent_id' => 'nullable',
        ]);

        $resp = $this->productCategoryInterface->update($request->all());
        return redirect()->route('admin.product.category.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->productCategoryInterface->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->productCategoryInterface->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
