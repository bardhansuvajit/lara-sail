<?php

namespace App\Http\Controllers\Admin\Product\Listing;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\CountryInterface;

class ProductListingController
{
    private ProductListingInterface $productListingRepository;
    private CountryInterface $countryRepository;

    public function __construct(ProductListingInterface $productListingRepository, CountryInterface $countryRepository)
    {
        $this->productListingRepository = $productListingRepository;
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,level',
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
        $resp = $this->productListingRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.product.listing.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        $countries_filters = [
            'status' => 1,
        ];
        $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');
        return view('admin.product.listing.create', [
            'activeCountries' => $activeCountries['data']
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // dd(implode(',', developerSettings('product_options')->type));

        $request->validate([
            'type' => 'required|string|in:'.implode(',', developerSettings('product_options')->type),
            'title' => 'required|string|min:2|max:1000',
            'description' => 'required|string|min:2',

            'category_id' => 'required|integer|min:1',
            'category_name' => 'required|string|min:2',
            'collection_id' => 'required|regex:/^\d+(,\d+)*$/', // regex for comma separated numbers
            'collection_name' => 'required|string|min:2',

            'currency' => 'required|integer|min:1|exists:countries,id',
            'selling_price' => 'required|numeric|min:1|max:1000000|regex:'.PRICE_REGEX,
            'mrp' => 'nullable|numeric|min:1|max:1000000|gt:selling_price|regex:'.PRICE_REGEX,
            'discount' => 'nullable|numeric|min:1|max:100|gt:selling_price|regex:'.PRICE_REGEX,
            'cost' => 'nullable|numeric|min:1|max:1000000|regex:'.PRICE_REGEX,
            'profit' => 'nullable|numeric|min:1|max:1000000|regex:'.PRICE_REGEX,
            'margin' => 'nullable|integer|min:1|max:99',
        ], [
            'selling_price.regex' => 'The selling price accepts value upto 2 decimals.',
            'mrp.regex' => 'The selling price accepts value upto 2 decimals.',
            'cost.regex' => 'The selling price accepts value upto 2 decimals.',
            'profit.regex' => 'The selling price accepts value upto 2 decimals.',
        ]);

        dd('final');

        // $resp = $this->productListingRepository->store($request->all());
        // return redirect()->route('admin.product.listing.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->productListingRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.product.listing.edit', [
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
            'title' => 'required|min:2|max:255',
            'level' => 'required|in:1,2,3,4',
            'parent_id' => 'required_if:level,2,3,4'
        ]);

        $resp = $this->productListingRepository->update($request->all());
        // dd($resp);
        return redirect()->route('admin.product.listing.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->productListingRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->productListingRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->productListingRepository->import($request->file('file'));
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

        $resp = $this->productListingRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }
}
