<?php

namespace App\Repositories;

use App\Interfaces\ProductListingInterface;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\ProductPricingInterface;
use App\Interfaces\ProductImageInterface;

use App\Exports\ProductListingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductListingRepository implements ProductListingInterface
{
    private TrashInterface $trashRepository;
    private CountryInterface $countryRepository;
    private ProductPricingInterface $productPricingRepository;
    private ProductImageInterface $productImageRepository;

    public function __construct(
        TrashInterface $trashRepository, 
        ProductPricingInterface $productPricingRepository, 
        ProductImageInterface $productImageRepository, 
        CountryInterface $countryRepository
    )
    {
        $this->trashRepository = $trashRepository;
        $this->productPricingRepository = $productPricingRepository;
        $this->productImageRepository = $productImageRepository;
        $this->countryRepository = $countryRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = Product::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('short_description', 'like', '%' . $keyword . '%')
                        ->orWhere('long_description', 'like', '%' . $keyword . '%')
                        ->orWhere('tags', 'like', '%' . $keyword . '%');
                });
            }

            // filters
            foreach ($filters as $field => $value) {
                if (!is_null($value) && $value !== '') {
                    if (is_array($value)) {
                        $query->whereIn($field, $value);
                    } else {
                        $query->where($field, '=', $value);
                    }
                }
            }

            // page
            $data = $perPage !== 'all'
            ? $query->orderBy($sortBy, $sortOrder)->paginate($perPage)->withQueryString()
            : $query->orderBy($sortBy, $sortOrder)->get();

            if ($data->isNotEmpty()) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            }
    
            return [
                'code' => 404,
                'status' => 'failure',
                'message' => 'No data found',
                'data' => [],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function store(Array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            // product listing
            $data = new Product();
            $data->type = $array['type'];
            $data->title = $array['title'];
            $data->slug = Str::slug($array['title']);
            $data->short_description = $array['short_description'];
            $data->long_description = $array['long_description'];
            $data->category_id = $array['category_id'];
            $data->collection_ids = $array['collection_ids'];

            $data->sku = $array['sku'];
            $data->quantity = $array['quantity'];
            $data->meta_title = $array['meta_title'];
            $data->meta_desc = $array['meta_description'];
            $data->status = 0;
            $data->save();

            // PRICING
            $countryData = $this->countryRepository->getById($array['currency_country_id']);
            if ($countryData['code'] == 200) {
                $currencyCode = $countryData['data']->currency_code;
                $currencySymbol = $countryData['data']->currency_symbol;
            }
            $pricingData = [
                'product_id' => $data->id,
                'country_id' => $array['currency_country_id'],
                'currency_code' => $currencyCode,
                'currency_symbol' => $currencySymbol,
                'selling_price' => $array['selling_price'],
                'mrp' => $array['mrp'],
                'discount' => $array['discount_percentage'],
                'cost' => $array['cost'],
                'profit' => $array['profit'],
                'margin' => $array['margin_percentage'],
            ];
            $pricingResp = $this->productPricingRepository->store($pricingData);

            // IMAGES
            if ($array['images'] && count($array['images']) > 0) {
                foreach($array['images'] as $imageKey => $singleImage) {
                    $uploadResp = fileUpload($singleImage, 'p-img');

                    $imageData = [
                        'product_id' => $data->id,
                        'image_s' => $uploadResp['smallThumbName'],
                        'image_m' => $uploadResp['mediumThumbName'],
                        'image_l' => $uploadResp['largeThumbName'],
                    ];
                    $imageResp = $this->productImageRepository->store($imageData);
                }
            }

            DB::commit();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $data,
            ];
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'code' => 500,
                'status' => 'error',
                // 'message' => 'An error occurred while storing data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getById(Int $id)
    {
        try {
            $data = Product::find($id);

            if (!empty($data)) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function update(Array $array)
    {
        // dd($array);

        DB::beginTransaction();

        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                $data['data']->type = $array['type'];
                $data['data']->title = $array['title'];
                $data['data']->slug = Str::slug($array['title']);
                $data['data']->short_description = $array['short_description'];
                $data['data']->long_description = $array['long_description'];
                $data['data']->category_id = $array['category_id'];
                $data['data']->collection_ids = $array['collection_ids'];

                $data['data']->sku = $array['sku'];
                $data['data']->quantity = $array['quantity'];
                $data['data']->meta_title = $array['meta_title'];
                $data['data']->meta_desc = $array['meta_description'];
                $data['data']->status = 0;
                $data['data']->save();

                // PRICING
                // **** pricing 1 - setting up data
                $countryData = $this->countryRepository->getById($array['currency_country_id']);
                if ($countryData['code'] == 200) {
                    $currencyCode = $countryData['data']->currency_code;
                    $currencySymbol = $countryData['data']->currency_symbol;
                }
                $pricingData = [
                    'product_id' => $array['id'],
                    'country_id' => $array['currency_country_id'],
                    'currency_code' => $currencyCode,
                    'currency_symbol' => $currencySymbol,
                    'selling_price' => $array['selling_price'],
                    'mrp' => $array['mrp'],
                    'discount' => $array['discount_percentage'],
                    'cost' => $array['cost'],
                    'profit' => $array['profit'],
                    'margin' => $array['margin_percentage'],
                ];

                // **** pricing 2 - check if pricing exists for this product id & country id
                $existingPricingData = $this->productPricingRepository->getByProductIdCountryId($array['id'], $array['currency_country_id']);

                // **** pricing 2 - if pricing exists update it, else add new
                if ($existingPricingData['code'] == 200) {
                    $existingPricingDataId = $existingPricingData['data']->id;
                    // dd($existingPricingDataId);
                    $pricingResp = $this->productPricingRepository->update($existingPricingDataId, $pricingData);
                } else {
                    $pricingResp = $this->productPricingRepository->store($pricingData);
                }

                // IMAGES
                if ($array['images'] && count($array['images']) > 0) {
                    foreach($array['images'] as $imageKey => $singleImage) {
                        $uploadResp = fileUpload($singleImage, 'p-img');

                        $imageData = [
                            'product_id' => $array['id'],
                            'image_s' => $uploadResp['smallThumbName'],
                            'image_m' => $uploadResp['mediumThumbName'],
                            'image_l' => $uploadResp['largeThumbName'],
                        ];
                        $imageResp = $this->productImageRepository->store($imageData);
                    }
                }

                DB::commit();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data,
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function delete(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'Product',
                    'table_name' => 'products',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from products table',
                    'status' => 'deleted',
                ]);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $data,
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while deleting data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function bulkAction(Array $array)
    {
        try {
            $data = Product::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'Product',
                        'table_name' => 'products',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from products table',
                        'status' => 'deleted',
                    ]);

                    $item->delete();
                });

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => [],
                ];
            } else {
                return [
                    'code' => 400,
                    'status' => 'failure',
                    'message' => 'Invalid action',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function import(UploadedFile $file)
    {
        try {
            $filePath = fileStore($file);
            $data = readCsvFile(public_path($filePath));
            $processedCount = saveToDatabase($data, 'Product');

            return [
                'code' => 200,
                'status' => 'success',
                'message' => $processedCount.' Data uploaded',
                'data' => [],
            ];
        } catch (\Exception $e) {
            \Log::error('CSV Import Error: ' . $e->getMessage());

            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while uploading data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "products_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductListingsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
                }
                else {
                    return [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Invalid export type.',
                    ];
                }
            } else {
                return [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'No data available for export.',
                ];
            }
        } catch (\Exception $e) {
            \Log::error('Export Repository Error: ' . $e->getMessage(), [
                'filters' => $filters,
                'exception' => $e
            ]);
    
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An unexpected error occurred while preparing the export.',
            ];
        }
    }
}
