<?php

namespace App\Http\Controllers\Admin\Product\Listing;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\CountryInterface;
use Illuminate\Validation\Rule;

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

        // Get uploaded files
        $uploadedFiles = $request->file('images');
        $fileNames = [];
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $index => $file) {
                $fileNames["images.$index"] = $file->getClientOriginalName();
            }
        }

        // $request->validate([
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|in:'.collect(PRODUCT_TYPE)->pluck('key')->implode(','),
            'title' => 'required|string|min:2|max:1000',
            'description' => 'required|string|min:2',
            'short_description' => 'nullable|string|min:2',

            'category_id' => 'required|integer|min:1',
            'category_name' => 'required|string|min:2',
            'collection_id' => 'required|regex:/^\d+(,\d+)*$/', // regex for comma separated numbers
            'collection_name' => 'required|string|min:2',

            'currency' => 'required|integer|min:1|exists:countries,id',
            'selling_price' => 'required|numeric|min:1|max:1000000|regex:'.PRICE_REGEX,
            'mrp' => 'nullable|numeric|min:1|max:1000000|gt:selling_price|regex:'.PRICE_REGEX,
            'discount' => 'nullable|numeric|min:0|max:100',
            'cost' => 'nullable|numeric|min:1|max:1000000|regex:'.PRICE_REGEX,
            'profit' => 'nullable|numeric|min:0|max:1000000|regex:'.PRICE_REGEX,
            'margin' => 'nullable|numeric|min:0|max:99',

            'track_quantity' => 'nullable|string|in:yes',
            'stock_quantity' => 'nullable|numeric|min:0|max:9999999999',
            'allow_backorders' => 'nullable|string|in:yes',

            'meta_title' => 'nullable|string|min:2|max:1000',
            'meta_description' => 'nullable|string|min:2',

            'images' => 'nullable|array',
            'images.*' => 'image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array)
        ], [
            'selling_price.regex' => 'The selling price accepts value upto 2 decimals.',
            'mrp.regex' => 'The selling price accepts value upto 2 decimals.',
            'cost.regex' => 'The selling price accepts value upto 2 decimals.',
            'profit.regex' => 'The selling price accepts value upto 2 decimals.',
            'images.*.max' => '":filename" must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
            'images.*.mimes' => '":filename" must be a file of type: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
        ]);

        $validator->after(function ($validator) use ($fileNames) {
            $messages = $validator->errors(); // Get validation errors

            foreach ($fileNames as $key => $fileName) {
                if ($messages->has($key)) {
                    $updatedErrors = [];

                    foreach ($messages->get($key) as $error) {
                        $updatedErrors[] = str_replace(':filename', $fileName, $error);
                    }

                    // Overwrite the errors for this key
                    $messages->forget($key);
                    $messages->add($key, $updatedErrors);
                }
            }
        });

        $validator->validate();

        $productData = [
            'type' => strtolower(str_replace(' ', '-', $request->type)),
            'title' => $request->title,
            'short_description' => $request->short_description ? $request->short_description : null,
            'long_description' => ($request->description != "<p>&nbsp;</p>") ? $request->description : null,
            'category_id' => (int) $request->category_id,
            'collection_ids' => json_encode(array_map('intval', explode(',', $request->collection_id))),

            'currency_country_id' => (int) $request->currency,
            'selling_price' => (float) filter_var($request->selling_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'mrp' => $request->mrp ? (float) filter_var($request->mrp, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0,
            'discount_percentage' => $request->mrp ? discountPercentageCalc($request->selling_price, $request->mrp) : 0,
            'cost' => $request->cost ? (float) filter_var($request->cost, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0,
            'profit' => $request->cost ? profitCalc($request->selling_price, $request->cost) : 0,
            'margin_percentage' => $request->cost ? marginCalc($request->selling_price, $request->cost) : 0,

            'sku' => $request->sku ? $request->sku : null,
            'track_quantity' => $request->track_quantity ? (bool) $request->track_quantity : false,
            'stock_quantity' => $request->stock_quantity ? (int) $request->stock_quantity : 0,
            'allow_backorders' => $request->allow_backorders ? (bool) $request->allow_backorders : false,
            'meta_title' => $request->meta_title ? $request->meta_title : null,
            'meta_description' => $request->meta_description ? $request->meta_title : null,

            'images' => $request->images ? $request->images : null
        ];

        // dd($productData);

        $resp = $this->productListingRepository->store($productData);
        return redirect()->route('admin.product.listing.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->productListingRepository->getById($id);
        if ($resp['code'] == 200) {
            $countries_filters = [
                'status' => 1,
            ];
            $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');
            return view('admin.product.listing.edit', [
                'data' => $resp['data'],
                'activeCountries' => $activeCountries['data']
            ]);
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());

        // Get uploaded files
        $uploadedFiles = $request->file('images');
        $fileNames = [];
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $index => $file) {
                $fileNames["images.$index"] = $file->getClientOriginalName();
            }
        }

        // $request->validate([
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|min:1',
            'type' => 'required|string|in:'.collect(PRODUCT_TYPE)->pluck('key')->implode(','),
            'title' => 'required|string|min:2|max:1000',
            'description' => 'required|string|min:2',
            'short_description' => 'nullable|string|min:2',

            'category_id' => 'required|integer|min:1',
            'category_name' => 'required|string|min:2',
            'collection_id' => 'required|regex:/^\d+(,\d+)*$/', // regex for comma separated numbers
            'collection_name' => 'required|string|min:2',

            'currency' => 'required|integer|min:1|exists:countries,id',
            'selling_price' => 'required|numeric|min:1|max:1000000|regex:'.PRICE_REGEX,
            'mrp' => [
                'nullable',
                'numeric',
                'min:0',
                'max:1000000',
                Rule::when(fn ($input) => $input['mrp'] > 0, 'gte:selling_price'),
                'regex:'.PRICE_REGEX
            ],
            'discount' => 'nullable|numeric|min:0|max:100',
            'cost' => 'nullable|numeric|min:0|max:1000000|regex:'.PRICE_REGEX,
            'profit' => 'nullable|numeric|min:0|max:1000000|regex:'.PRICE_REGEX,
            'margin' => 'nullable|numeric|min:0|max:99',

            'track_quantity' => 'nullable|string|in:yes',
            'stock_quantity' => 'nullable|numeric|min:0|max:9999999999',
            'allow_backorders' => 'nullable|string|in:yes',

            'meta_title' => 'nullable|string|min:2|max:1000',
            'meta_description' => 'nullable|string|min:2',

            'images' => 'nullable|array',
            'images.*' => 'image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array)
        ], [
            'selling_price.regex' => 'The selling price accepts value upto 2 decimals.',
            'mrp.regex' => 'The selling price accepts value upto 2 decimals.',
            'cost.regex' => 'The selling price accepts value upto 2 decimals.',
            'profit.regex' => 'The selling price accepts value upto 2 decimals.',
            'images.*.max' => '":filename" must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
            'images.*.mimes' => '":filename" must be a file of type: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
        ]);

        $validator->after(function ($validator) use ($fileNames) {
            $messages = $validator->errors(); // Get validation errors

            foreach ($fileNames as $key => $fileName) {
                if ($messages->has($key)) {
                    $updatedErrors = [];

                    foreach ($messages->get($key) as $error) {
                        $updatedErrors[] = str_replace(':filename', $fileName, $error);
                    }

                    // Overwrite the errors for this key
                    $messages->forget($key);
                    $messages->add($key, $updatedErrors);
                }
            }
        });

        $validator->validate();

        $productData = [
            'id' => $request->id,
            'type' => strtolower(str_replace(' ', '-', $request->type)),
            'title' => $request->title,
            'short_description' => $request->short_description ? $request->short_description : null,
            'long_description' => ($request->description != "<p>&nbsp;</p>") ? $request->description : null,
            'category_id' => (int) $request->category_id,
            'collection_ids' => json_encode(array_map('intval', explode(',', $request->collection_id))),
            'currency_country_id' => (int) $request->currency,
            'selling_price' => (float) filter_var($request->selling_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'mrp' => $request->mrp ? (float) filter_var($request->mrp, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0,
            'discount_percentage' => $request->mrp ? discountPercentageCalc($request->selling_price, $request->mrp) : 0,
            'cost' => $request->cost ? (float) filter_var($request->cost, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0,
            'profit' => $request->cost ? profitCalc($request->selling_price, $request->cost) : 0,
            'margin_percentage' => $request->cost ? marginCalc($request->selling_price, $request->cost) : 0,

            'sku' => $request->sku ? $request->sku : null,
            'track_quantity' => $request->track_quantity ? (bool) $request->track_quantity : false,
            'stock_quantity' => $request->stock_quantity ? (int) $request->stock_quantity : 0,
            'allow_backorders' => $request->allow_backorders ? (bool) $request->allow_backorders : false,
            'meta_title' => $request->meta_title ? $request->meta_title : null,
            'meta_description' => $request->meta_description ? $request->meta_title : null,

            'images' => $request->images ? $request->images : null
        ];

        // dd($productData);

        $resp = $this->productListingRepository->update($productData);
        // dd($resp);
        return redirect()->back()->with($resp['status'], $resp['message']);
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
