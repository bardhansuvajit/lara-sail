<?php

namespace App\Http\Controllers\Admin\Product\Variation;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\ProductVariationInterface;

class ProductVariationController
{
    private ProductVariationInterface $productVariationRepository;

    public function __construct(ProductVariationInterface $productVariationRepository)
    {
        $this->productVariationRepository = $productVariationRepository;
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->productVariationRepository->getById($id);
        if ($resp['code'] == 200) {
            return view('admin.product.variation.listing.edit', [
                'data' => $resp['data'],
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
            'variation_identifier' => 'required|string',
            'sku' => 'nullable|string|max:50',
            'barcode' => 'nullable|string|max:50',
            // 'variation_identifier' => 'required|string|unique:product_variations,variation_identifier,product_variation_id'.$request->id,
            // 'sku' => 'nullable|string|max:50|unique:product_variations,sku,'.$request->id,
            // 'barcode' => 'nullable|string|max:50|unique:product_variations,barcode,'.$request->id,

            'track_quantity' => 'nullable|string|in:yes',
            'stock_quantity' => 'nullable|numeric|min:0|max:9999999999',
            'allow_backorders' => 'nullable|string|in:yes',

            // 'price_adjustment' => 'nullable|numeric',
            // 'adjustment_type' => 'nullable|in:fixed,percentage',

            'country_code'       => 'required|array|min:1',
            'country_code.*'     => 'required|string|exists:countries,code',
            // selling prices (required array)
            'selling_price'      => 'required|array|min:1',
            'selling_price.*'    => ['required','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            // mrp can be nullable per item
            'mrp'                => 'nullable|array',
            'mrp.*'              => ['nullable','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            // discount/profit/margin arrays (readonly front-end but validate anyway)
            'discount'           => 'nullable|array',
            'discount.*'         => ['nullable','numeric','min:0','max:100'],
            'cost'               => 'nullable|array',
            'cost.*'             => ['nullable','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            'profit'             => 'nullable|array',
            'profit.*'           => ['nullable','numeric','min:0','max:1000000','regex:'.PRICE_REGEX],
            'margin'             => 'nullable|array',
            'margin.*'           => ['nullable','numeric','min:0','max:99'],

            'weight_adjustment' => 'nullable|min:0',
            'weight_unit' => 'nullable|in:g,kg,lb,oz',

            'length_adjustment' => 'nullable|min:0',
            'width_adjustment' => 'nullable|min:0',
            'height_adjustment' => 'nullable|min:0',
            'dimension_unit' => 'nullable|in:mm,cm,m,in,ft',

            'images' => 'nullable|array',
            'images.*' => 'image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array)
        ], [
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

        // gather input arrays (guaranteed by validator to exist for required fields)
        $priceIds = $request->input('price_ids', []);
        $countryCodes = $request->input('country_code', []);
        $sellingPrices = $request->input('selling_price', []);
        $mrps = $request->input('mrp', []);
        $costs = $request->input('cost', []);
        // discount/profit/margin are computed on server; ignore incoming values if you prefer

        $pricing = [];
        $entries = count($sellingPrices); // selling_price is required; use its count

        for ($i = 0; $i < $entries; $i++) {
            $pId = $priceIds[$i] ?? null;
            $cc = $countryCodes[$i] ?? null;
            $selling = floatConvert($sellingPrices[$i] ?? 0);
            // treat empty mrp as 0 (or null)
            $mrpRaw = $mrps[$i] ?? null;
            $mrp = ($mrpRaw === '' || is_null($mrpRaw)) ? 0.0 : floatConvert($mrpRaw);

            $discountPercentage = ($mrp > 0) ? discountPercentageCalc($selling, $mrp) : 0;

            $costRaw = $costs[$i] ?? null;
            $cost = ($costRaw === '' || is_null($costRaw)) ? 0.0 : floatConvert($costRaw);

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

        $data = [
            'id' => $request->id,
            'variation_identifier' => $request->variation_identifier ? $request->variation_identifier : null,
            'sku' => $request->sku ? $request->sku : null,
            'track_quantity' => $request->track_quantity ? (bool) $request->track_quantity : false,
            'stock_quantity' => $request->stock_quantity ? (int) $request->stock_quantity : 0,
            'allow_backorders' => $request->allow_backorders ? (bool) $request->allow_backorders : false,

            // 'price_adjustment' => $request->price_adjustment ? $request->price_adjustment : null,
            // 'adjustment_type' => $request->adjustment_type ? $request->adjustment_type : 'fixed',

            'pricing' => $pricing,

            'weight_adjustment' => $request->weight_adjustment ? $request->weight_adjustment : 0,
            'length_adjustment' => $request->length_adjustment ? $request->length_adjustment : 0,
            'width_adjustment' => $request->width_adjustment ? $request->width_adjustment : 0,
            'height_adjustment' => $request->height_adjustment ? $request->height_adjustment : 0,
            'weight_unit' => $request->weight_unit ? $request->weight_unit : 'g',
            'dimension_unit' => $request->dimension_unit ? $request->dimension_unit : 'cm',

            'images' => $request->images ? $request->images : null
        ];

        // dd($data);

        $resp = $this->productVariationRepository->update($data);
        return redirect()->back()->with($resp['status'], $resp['message']);
        // return redirect()->route('admin.product.variation.attribute.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->productVariationRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
