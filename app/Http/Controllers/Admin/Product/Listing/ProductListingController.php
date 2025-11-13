<?php

namespace App\Http\Controllers\Admin\Product\Listing;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ProductStatusInterface;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\DeveloperSettingInterface;
use Illuminate\Validation\Rule;

use App\Models\Product;

class ProductListingController
{
    private ProductStatusInterface $productStatusRepository;
    private ProductListingInterface $productListingRepository;
    private CountryInterface $countryRepository;
    private DeveloperSettingInterface $developerSettingRepository;

    public function __construct(
        ProductStatusInterface $productStatusRepository, 
        ProductListingInterface $productListingRepository, 
        CountryInterface $countryRepository, 
        DeveloperSettingInterface $developerSettingRepository
    )
    {
        $this->productStatusRepository = $productStatusRepository;
        $this->productListingRepository = $productListingRepository;
        $this->countryRepository = $countryRepository;
        $this->developerSettingRepository = $developerSettingRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,level',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|integer'
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $resp = $this->productListingRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        $allStatusResp = $this->productStatusRepository->list('', ['status' => 1], 'all', 'position', 'asc');

        return view('admin.product.listing.index', [
            'data' => $resp['data'],
            'allStatus' => $allStatusResp['data'],
        ]);
    }

    public function create(): View
    {
        // $countries_filters = [
        //     'status' => 1,
        // ];
        // $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');

        // product type
        $companyDomain = applicationSettings('company_domain');
        $productTypes = json_decode($this->developerSettingRepository->getByKey('company_category')['data']->value);
        $productType = collect($productTypes)->firstWhere('key', $companyDomain);

        return view('admin.product.listing.create', [
            // 'activeCountries' => $activeCountries['data'],
            'productType' => $productType
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());

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
            'type' => 'required|string',
            'title' => 'required|string|min:2|max:1000',
            'description' => 'nullable|string|min:2',
            'short_description' => 'nullable|string|min:2',

            'category_id' => 'nullable|integer|min:0',
            'category_name' => 'nullable|string|min:2',
            'collection_id' => 'nullable|regex:/^\d+(,\d+)*$/',
            'collection_name' => 'nullable|string|min:2',

            'country_code'       => 'required|array|min:1',
            'country_code.*'     => 'required|string|exists:countries,code',
            'selling_price'      => 'nullable|array|min:1',
            'selling_price.*'    => ['nullable','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            'mrp'                => 'nullable|array',
            'mrp.*'              => ['nullable','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            'discount'           => 'nullable|array',
            'discount.*'         => ['nullable','numeric','min:0','max:100'],
            'cost'               => 'nullable|array',
            'cost.*'             => ['nullable','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            'profit'             => 'nullable|array',
            'profit.*'           => ['nullable','numeric','min:0','max:1000000','regex:'.PRICE_REGEX],
            'margin'             => 'nullable|array',
            'margin.*'           => ['nullable','numeric','min:0','max:99'],

            'track_quantity' => 'nullable|string|in:yes',
            'stock_quantity' => 'nullable|numeric|min:0|max:9999999999',
            'allow_backorders' => 'nullable|string|in:yes',

            'meta_title' => 'nullable|string|min:2|max:1000',
            'meta_description' => 'nullable|string|min:2',

            'images' => 'nullable|array',
            'images.*' => 'image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array)
        ], [
            'selling_price.regex' => 'The selling price accepts value upto 2 decimals.',
            'mrp.regex' => 'The selling price accepts value upto 2 decimals.',
            'cost.regex' => 'The selling price accepts value upto 2 decimals.',
            'profit.regex' => 'The selling price accepts value upto 2 decimals.',
            'images.*.max' => '":filename" must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
            'images.*.mimes' => '":filename" must be a file of type: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            'images.*.extensions' => '":filename" is not supported. Please upload an image of these formats: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
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

        $toFloat = function ($val) {
            if ($val === null || $val === '') return 0.0; // or return null if you prefer
            // normalize comma decimal to dot, trim spaces
            $s = trim((string) $val);
            $s = str_replace(',', '.', $s);
            // sanitize and cast
            $num = filter_var($s, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            return (float) $num;
        };

        // gather input arrays (guaranteed by validator to exist for required fields)
        $countryCodes = $request->input('country_code', []);
        $sellingPrices = $request->input('selling_price', []);
        $mrps = $request->input('mrp', []);
        $costs = $request->input('cost', []);
        // discount/profit/margin are computed on server; ignore incoming values if you prefer

        $pricing = [];
        $entries = !empty($sellingPrices) ? count($sellingPrices) : 0; // selling_price is required; use its count

        for ($i = 0; $i < $entries; $i++) {
            $cc = $countryCodes[$i] ?? null;
            $selling = $toFloat($sellingPrices[$i] ?? 0);
            // treat empty mrp as 0 (or null)
            $mrpRaw = $mrps[$i] ?? null;
            $mrp = ($mrpRaw === '' || is_null($mrpRaw)) ? 0.0 : $toFloat($mrpRaw);

            $discountPercentage = ($mrp > 0) ? discountPercentageCalc($selling, $mrp) : 0;

            $costRaw = $costs[$i] ?? null;
            $cost = ($costRaw === '' || is_null($costRaw)) ? 0.0 : $toFloat($costRaw);

            $profit = ($cost > 0) ? profitCalc($selling, $cost) : 0;
            $marginPercentage = ($cost > 0) ? marginCalc($selling, $cost) : 0;

            $pricing[] = [
                'country_code' => $cc,
                'selling_price' => $selling,
                'mrp' => $mrp,
                'discount_percentage' => $discountPercentage,
                'cost' => $cost,
                'profit' => $profit,
                'margin_percentage' => $marginPercentage,
            ];
        }

        $productData = [
            'type' => strtolower(str_replace(' ', '-', $request->type)),
            'title' => $request->title,
            'short_description' => $request->short_description ? $request->short_description : null,
            'long_description' => ($request->description != "<p>&nbsp;</p>") ? $request->description : null,
            'category_id' => (int) $request->category_id,
            'collection_ids' => json_encode(array_map('intval', explode(',', $request->collection_id))),

            'pricing' => $pricing,

            'sku' => $request->sku ? $request->sku : null,
            'track_quantity' => $request->track_quantity ? (bool) $request->track_quantity : false,
            'stock_quantity' => $request->stock_quantity ? (int) $request->stock_quantity : 0,
            'allow_backorders' => $request->allow_backorders ? (bool) $request->allow_backorders : false,
            'meta_title' => $request->meta_title ? $request->meta_title : null,
            'meta_description' => $request->meta_description ? $request->meta_description : null,

            'images' => $request->images ? $request->images : null
        ];

        // dd($productData);

        $resp = $this->productListingRepository->store($productData);
        $productId = $resp['data']->id;
        return redirect()->route('admin.product.listing.edit', $productId)->with($resp['status'], $resp['message']);
    }

    public function edit(int $id): View|RedirectResponse
    {
        $resp = $this->productListingRepository->getById($id);
        if ($resp['code'] == 200) {
            $countries_filters = [
                'status' => 1,
            ];
            $activeCountries = $this->countryRepository->list('', $countries_filters, 'all', 'name', 'asc');

            // product type
            $companyDomain = applicationSettings('company_domain');
            $productTypes = json_decode($this->developerSettingRepository->getByKey('company_category')['data']->value);
            $productType = collect($productTypes)->firstWhere('key', $companyDomain);

            $allStatusResp = $this->productStatusRepository->list('', ['status' => 1], 'all', 'position', 'asc');

            return view('admin.product.listing.edit', [
                'data' => $resp['data'],
                'activeCountries' => $activeCountries['data'],
                'productType' => $productType,
                'allStatus' => $allStatusResp['data'],
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
            // 'type' => 'required|string|in:'.collect(PRODUCT_TYPE)->pluck('key')->implode(','),
            'type' => 'required|string',
            'title' => 'required|string|min:2|max:1000',
            'description' => 'nullable|string|min:2',
            'short_description' => 'nullable|string|min:2',

            'category_id' => 'nullable|integer|min:0',
            'category_name' => 'nullable|string|min:2',
            'collection_id' => 'nullable|regex:/^\d+(,\d+)*$/',
            'collection_name' => 'nullable|string|min:2',

            'price_ids'       => 'required|array|min:1',
            'price_ids.*'     => 'required|integer|min:1',
            'country_code'       => 'required|array|min:1',
            'country_code.*'     => 'required|string|exists:countries,code',
            // selling prices (required array)
            'selling_price'      => 'nullable|array|min:1',
            'selling_price.*'    => ['nullable','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            // mrp can be nullable per item
            'mrp'                => 'nullable|array',
            'mrp.*'              => ['nullable','numeric','max:1000000','regex:'.PRICE_REGEX],
            // discount/profit/margin arrays (readonly front-end but validate anyway)
            'discount'           => 'nullable|array',
            'discount.*'         => ['nullable','numeric','min:0','max:100'],
            'cost'               => 'nullable|array',
            'cost.*'             => ['nullable','numeric','max:1000000','regex:'.PRICE_REGEX],
            'profit'             => 'nullable|array',
            'profit.*'           => ['nullable','numeric','min:0','max:1000000','regex:'.PRICE_REGEX],
            'margin'             => 'nullable|array',
            'margin.*'           => ['nullable','numeric','min:0','max:99'],

            'track_quantity' => 'nullable|string|in:yes',
            'stock_quantity' => 'nullable|numeric|min:0|max:9999999999',
            'allow_backorders' => 'nullable|string|in:yes',

            'meta_title' => 'nullable|string|min:2|max:1000',
            'meta_description' => 'nullable|string|min:2',

            'images' => 'nullable|array',
            'images.*' => 'image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),

            'status' => 'required|integer|min:1',

            'badge_ids'             => 'nullable|array',
            'badge_ids.*'           => ['nullable','integer','min:1','exists:product_badges,id'],
        ], [
            'selling_price.regex' => 'The selling price accepts value upto 2 decimals.',
            'mrp.regex' => 'The selling price accepts value upto 2 decimals.',
            'cost.regex' => 'The selling price accepts value upto 2 decimals.',
            'profit.regex' => 'The selling price accepts value upto 2 decimals.',
            'images.*.max' => '":filename" must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
            'images.*.mimes' => '":filename" must be a file of type: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            'images.*.extensions' => '":filename" is not supported. Please upload an image of these formats: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
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

        // Get removed price IDs
        $removedPriceIds = [];
        if ($request->has('removed_price_ids') && !empty($request->removed_price_ids)) {
            $removedPriceIds = array_filter(explode(',', $request->removed_price_ids));
        }

        $toFloat = function ($val) {
            if ($val === null || $val === '') return 0.0; // or return null if you prefer
            // normalize comma decimal to dot, trim spaces
            $s = trim((string) $val);
            $s = str_replace(',', '.', $s);
            // sanitize and cast
            $num = filter_var($s, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            return (float) $num;
        };

        // gather input arrays (guaranteed by validator to exist for required fields)
        $priceIds = $request->input('price_ids', []);
        $countryCodes = $request->input('country_code', []);
        $sellingPrices = $request->input('selling_price', []);
        $mrps = $request->input('mrp', []);
        $costs = $request->input('cost', []);
        // discount/profit/margin are computed on server; ignore incoming values if you prefer

        $pricing = [];
        $entries = !empty($sellingPrices) ? count($sellingPrices) : 0;

        for ($i = 0; $i < $entries; $i++) {
            $pId = $priceIds[$i] ?? null;
            $cc = $countryCodes[$i] ?? null;
            $selling = $toFloat($sellingPrices[$i] ?? 0);
            // treat empty mrp as 0 (or null)
            $mrpRaw = $mrps[$i] ?? null;
            $mrp = ($mrpRaw === '' || is_null($mrpRaw)) ? 0.0 : $toFloat($mrpRaw);

            $discountPercentage = ($mrp > 0) ? discountPercentageCalc($selling, $mrp) : 0;

            $costRaw = $costs[$i] ?? null;
            $cost = ($costRaw === '' || is_null($costRaw)) ? 0.0 : $toFloat($costRaw);

            $profit = ($cost > 0) ? profitCalc($selling, $cost) : 0;
            $marginPercentage = ($cost > 0) ? marginCalc($selling, $cost) : 0;

            $pricing[] = [
                'id' => $pId,
                'country_code' => $cc,
                'selling_price' => $selling,
                'mrp' => $mrp,
                'discount_percentage' => $discountPercentage,
                'cost' => $cost,
                'profit' => $profit,
                'margin_percentage' => $marginPercentage,
            ];
        }

        $productData = [
            'id' => $request->id,
            'type' => strtolower(str_replace(' ', '-', $request->type)),
            'title' => $request->title,
            'short_description' => $request->short_description ? $request->short_description : null,
            'long_description' => ($request->description != "<p>&nbsp;</p>") ? $request->description : null,
            // 'category_id' => (int) $request->category_id,
            // 'collection_ids' => json_encode(array_map('intval', explode(',', $request->collection_id))),

            'category_id' => $request->category_id ? (int) $request->category_id : null,
            'collection_ids' => $request->collection_id ? json_encode(array_map('intval', explode(',', $request->collection_id))) : null,

            // 'country_code' => $request->country_code,
            // 'selling_price' => (float) filter_var($request->selling_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            // 'mrp' => $request->mrp ? (float) filter_var($request->mrp, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0,
            // 'discount_percentage' => $request->mrp ? discountPercentageCalc($request->selling_price, $request->mrp) : 0,
            // 'cost' => $request->cost ? (float) filter_var($request->cost, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0,
            // 'profit' => $request->cost ? profitCalc($request->selling_price, $request->cost) : 0,
            // 'margin_percentage' => $request->cost ? marginCalc($request->selling_price, $request->cost) : 0,

            'pricing' => $pricing,
            'removed_price_ids' => $removedPriceIds,

            'sku' => $request->sku ? $request->sku : null,
            'track_quantity' => $request->track_quantity ? (bool) $request->track_quantity : false,
            'stock_quantity' => $request->stock_quantity ? (int) $request->stock_quantity : 0,
            'allow_backorders' => $request->allow_backorders ? (bool) $request->allow_backorders : false,
            'meta_title' => $request->meta_title ? $request->meta_title : null,
            'meta_description' => $request->meta_description ? $request->meta_description : null,

            'images' => $request->images ? $request->images : null,

            'status' => (int) $request->status ? $request->status : 2,

            'badges' => $request->badge_ids
        ];

        // dd($productData);

        $resp = $this->productListingRepository->update($productData);
        // dd($resp);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function delete(int $id)
    {
        $resp = $this->productListingRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all(), $request->action);

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive,edit',
        ]);

        if ($request->action == "edit") {
            return redirect()->route('admin.product.listing.bulk.edit')
            ->with('edit_ids', $request->ids);
        } else {
            $resp = $this->productListingRepository->bulkAction($request->except('_token'));
            return redirect()->back()->with($resp['status'], $resp['message']);
        }
    }

    public function bulkEdit()
    {
        if (!session()->has('edit_ids')) {
            return redirect()->back()->with('error', 'No products selected for editing');
        }
    
        $ids = session()->pull('edit_ids');
        
        $resp = $this->productListingRepository->getByIds($ids);
        
        if ($resp['code'] !== 200) {
            return redirect()->back()->with('error', $resp['message']);
        }
    
        return view('admin.product.listing.bulk-edit', [
            'data' => $resp['data']
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|array',
            'id.*' => 'exists:products,id',
            'title' => 'required|array',
            'title.*' => 'string|max:255',
            'slug' => 'required|array',
            'slug.*' => [
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $productId = $request->id[$index];
                    
                    if (Product::where('slug', $value)
                        ->where('id', '!=', $productId)
                        ->exists()) {
                        $fail('The slug has already been taken.');
                    }
                },
            ],
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->id as $index => $id) {
                $this->productListingRepository->update([
                    'id' => $id,
                    'title' => $request->title[$index],
                    'slug' => $request->slug[$index],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.product.listing.bulk.edit')
                ->with([
                    'success' => count($request->id) . ' products updated successfully',
                    'edit_ids' => $request->id
                ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk update failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update products. Please try again.');
        }

        // foreach ($request->id as $index => $id) {
        //     $productData = [
        //         'id' => $id,
        //         'title' => $request->title[$index],
        //         'slug' => $request->slug[$index],
        //     ];

        //     $this->productListingRepository->update($productData);
        // }

        // return redirect()->route('admin.product.listing.bulk.edit')
        //     ->with('edit_ids', $request->id);

        // return redirect()->back();
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
            'status' => 'nullable|string'
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
