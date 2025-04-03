<?php

namespace App\Http\Controllers\Admin\Product\Pricing;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductPricingInterface;

class ProductPricingController
{
    private ProductPricingInterface $productPricingRepository;

    public function __construct(ProductPricingInterface $productPricingRepository)
    {
        $this->productPricingRepository = $productPricingRepository;
    }

    // public function index(Request $request): View
    // {
    //     // dd($request->all());

    //     $request->validate([
    //         'keyword' => 'nullable|string|max:255',
    //         'perPage' => 'nullable|string',
    //         'sortBy' => 'nullable|string|in:id,title,slug',
    //         'sortOrder' => 'nullable|string|in:asc,desc',
    //         'status' => 'nullable|string|in:0,1'
    //     ]);

    //     $perPage = $request->input('perPage', 15);
    //     $keyword = $request->input('keyword', '');
    //     $sortBy = $request->input('sortBy', 'id');
    //     $sortOrder = $request->input('sortOrder', 'desc');
    //     $filters = [
    //         'status' => $request->input('status', ''),
    //     ];
    //     $resp = $this->productPricingRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

    //     return view('admin.product.Pricing.index', [
    //         'data' => $resp['data'],
    //     ]);
    // }

    // public function create(): View
    // {
    //     return view('admin.product.Pricing.create');
    // }

    // public function store(Request $request)
    // {
    //     // dd($request->all());

    //     $request->validate([
    //         'image' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
    //         'title' => 'required|min:2|max:255'
    //     ], [
    //         'image.max' => 'The image field must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
    //     ]);

    //     $resp = $this->productPricingRepository->store($request->all());
    //     return redirect()->route('admin.product.Pricing.index')->with($resp['status'], $resp['message']);
    // }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->productPricingRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.product.Pricing.edit', [
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
            'id' => 'required|integer',
            'image' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            'title' => 'required|min:2|max:255'
        ]);

        $resp = $this->productPricingRepository->update($request->all());
        // dd($resp);
        return redirect()->route('admin.product.Pricing.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->productPricingRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    // public function bulk(Request $request)
    // {
    //     // dd($request->all());

    //     $request->validate([
    //         'ids' => 'required|array',
    //         'action' => 'required|in:delete,archive',
    //     ]);

    //     $resp = $this->productPricingRepository->bulkAction($request->except('_token'));
    //     return redirect()->back()->with($resp['status'], $resp['message']);
    // }

    // public function import(Request $request)
    // {
    //     $request->validateWithBag('importForm', [
    //         'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
    //     ]);

    //     $resp = $this->productPricingRepository->import($request->file('file'));
    //     return redirect()->back()->with($resp['status'], $resp['message']);
    // }

    // public function export(Request $request, String $type)
    // {
    //     $request->validate([
    //         'keyword' => 'nullable|string|max:255',
    //         'perPage' => 'nullable|string',
    //         'sortBy' => 'nullable|string|in:id,title,slug',
    //         'sortOrder' => 'nullable|string|in:asc,desc',
    //         'status' => 'nullable|string|in:0,1'
    //     ]);

    //     $perPage = $request->input('perPage', 15);
    //     $keyword = $request->input('keyword', '');
    //     $sortBy = $request->input('sortBy', 'id');
    //     $sortOrder = $request->input('sortOrder', 'desc');
    //     $filters = [
    //         'status' => $request->input('status', ''),
    //     ];

    //     $resp = $this->productPricingRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
    //     if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
    //         return $resp;
    //     }

    //     return redirect()->back()->with('error', $resp['message']);
    // }
}
