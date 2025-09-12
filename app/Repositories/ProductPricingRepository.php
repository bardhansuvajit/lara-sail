<?php

namespace App\Repositories;

use App\Interfaces\ProductPricingInterface;
use App\Models\ProductPricing;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

use App\Exports\ProductListingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductPricingRepository implements ProductPricingInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductPricing::query();

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
            $data = new ProductPricing();
            $data->product_id = $array['product_id'];
            $data->product_variation_id = $array['product_variation_id'] ?? null;
            $data->country_code = $array['country_code'];

            $data->selling_price = $array['selling_price'];
            $data->mrp = $array['mrp'];
            $data->discount = $array['discount'];
            $data->cost = $array['cost'];
            $data->profit = $array['profit'];
            $data->margin = $array['margin'];
            $data->status = 1;
            $data->save();

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
                'message' => 'An error occurred while storing data.',
                // 'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getById(Int $id)
    {
        try {
            $data = ProductPricing::find($id);

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

    public function getByProductIdCountryCode(Int $productId, String $countryCode)
    {
        try {
            $data = ProductPricing::where([
                ['product_id', $productId],
                ['country_code', $countryCode]
            ])->first();

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

    public function update(Int $id, Array $array)
    {
        // dd($id, $array);

        try {
            // $data = $this->getById($array['id']);
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // dd($data['data']);
                $data['data']->product_id = $array['product_id'];
                $data['data']->country_code = $array['country_code'];
                // $data['data']->country_id = $array['country_id'];
                // $data['data']->currency_code = $array['currency_code'];
                // $data['data']->currency_symbol = $array['currency_symbol'];

                $data['data']->selling_price = $array['selling_price'];
                $data['data']->mrp = $array['mrp'];
                $data['data']->discount = $array['discount'];
                $data['data']->cost = $array['cost'];
                $data['data']->profit = $array['profit'];
                $data['data']->margin = $array['margin'];
                $data['data']->status = 1;
                $data['data']->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data['data'],
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
                    'model' => 'ProductPricing',
                    'table_name' => 'product_pricings',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s ?? null,
                    'title' => $data['data']->currency_code,
                    'description' => $data['data']->currency_symbol.' ('.$data['data']->currency_code.') currency data deleted from product_pricings table',
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
            $data = ProductPricing::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'ProductPricing',
                        'table_name' => 'product_pricings',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from product_pricings table',
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
            // $processedCount = saveToDatabase($data, 'ProductPricing');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['product_id'])) {
                    continue; // Skip rows without a product_id
                }

                Country::create([
                    'product_id' => $item['product_id'] ? $item['product_id'] : null,
                    'product_variation_id' => $item['product_variation_id'] ? $item['product_variation_id'] : null,
                    'country_code' => $item['country_code'] ? $item['country_code'] : null,
                    // 'country_id' => $item['country_id'] ? $item['country_id'] : null,
                    // 'currency_code' => $item['currency_code'] ? $item['currency_code'] : null,
                    // 'currency_symbol' => $item['currency_symbol'] ? $item['currency_symbol'] : null,
                    'min_quantity' => $item['min_quantity'] ? $item['min_quantity'] : null,
                    'price_type' => $item['price_type'] ? $item['price_type'] : 'regular',
                    'selling_price' => $item['selling_price'] ? $item['selling_price'] : 0,
                    'mrp' => $item['mrp'] ? $item['mrp'] : 0,
                    'discount' => $item['discount'] ? $item['discount'] : 0,
                    'cost' => $item['cost'] ? $item['cost'] : 0,
                    'profit' => $item['profit'] ? $item['profit'] : 0,
                    'margin' => $item['margin'] ? $item['margin'] : 0,
                    'status' => $item['status'] ? $item['status'] : 0
                ]);

                $processedCount++;
            }

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
                $fileName = "product_pricings_export_" . date('Y-m-d') . '-' . time();

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
