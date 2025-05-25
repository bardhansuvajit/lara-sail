<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodInterface;
use App\Models\PaymentMethod;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

use App\Exports\CartItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentMethodRepository implements PaymentMethodInterface
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
            $query = PaymentMethod::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('country_code', 'like', '%' . $keyword . '%')
                        ->orWhere('method', 'like', '%' . $keyword . '%')
                        ->orWhere('title', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%')
                        ->orWhere('charge_title', 'like', '%' . $keyword . '%')
                        ->orWhere('discount_title', 'like', '%' . $keyword . '%');
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
        // dd($array['image']);
        try {
            $data = new PaymentMethod();
            $data->user_id = $array['user_id'];
            $data->address_type = $array['address_type'];
            $data->is_default = !empty($array['is_default']) ? $array['is_default'] : 0;
            $data->first_name = !empty($array['first_name']) ? $array['first_name'] : null;
            $data->last_name = !empty($array['last_name']) ? $array['last_name'] : null;
            $data->company = !empty($array['company']) ? $array['company'] : null;
            $data->address_line_1 = !empty($array['address_line_1']) ? $array['address_line_1'] : null;
            $data->address_line_2 = !empty($array['address_line_2']) ? $array['address_line_2'] : null;
            $data->city = !empty($array['city']) ? $array['city'] : null;
            $data->state = !empty($array['state']) ? $array['state'] : null;
            $data->postal_code = !empty($array['postal_code']) ? $array['postal_code'] : null;
            $data->country_code = !empty($array['country_code']) ? $array['country_code'] : null;
            $data->phone_no = !empty($array['phone_no']) ? $array['phone_no'] : null;
            $data->email = !empty($array['email']) ? $array['email'] : null;

            $data->landmark = !empty($array['landmark']) ? $array['landmark'] : null;
            $data->additional_notes = !empty($array['additional_notes']) ? $array['additional_notes'] : null;
            $data->alt_phone_no = !empty($array['alt_phone_no']) ? $array['alt_phone_no'] : null;

            $data->save();

            // Change other addresses default to 0
            if (!empty($array['is_default']) && $array['is_default'] == 1) {
                $resp = $this->exists([
                    'user_id' => $array['user_id'],
                    'address_type' => $array['address_type'],
                ]);

                if ($resp['code'] == 200) {
                    foreach ($resp['data'] as $key => $address) {
                        if ($address->id != $data->id) {
                            $address->is_default = 0;
                            $address->save();
                        }
                    }
                }
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $data,
            ];
        } catch (\Exception $e) {
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
            $data = PaymentMethod::with('countryDetails')
            ->find($id);

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

    public function exists(Array $conditions)
    {
        try {
            $data = PaymentMethod::where($conditions)->get();

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
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                if (isset($array['method']))                           $data['data']->method = $array['method'];
                if (isset($array['title']))                            $data['data']->title = $array['title'];
                if (isset($array['description']))                      $data['data']->description = $array['description'];
                if (isset($array['charge_title']))                     $data['data']->charge_title = $array['charge_title'];
                if (isset($array['charge_amount']))                    $data['data']->charge_amount = $array['charge_amount'];
                if (isset($array['discount_title']))                   $data['data']->discount_title = $array['discount_title'];
                if (isset($array['discount_amount']))                  $data['data']->discount_amount = $array['discount_amount'];
                $data['data']->charge_type = $array['charge_type'];
                $data['data']->discount_type = $array['discount_type'];

                $data['data']->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data
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
                $PaymentMethod = $data['data'];

                // dd($PaymentMethod);

                // Handling trash
                $trashData = $this->trashRepository->store([
                    'model' => 'PaymentMethod',
                    'table_name' => 'user_addresses',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->product_title,
                    'description' => $data['data']->product_title.' & '. $data['data']->variation_attributes.' data deleted from user addresses table',
                    'status' => 'deleted',
                ]);

                // dd($trashData);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $PaymentMethod,
                    'cart' => $PaymentMethod->cart
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
            $data = PaymentMethod::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {

                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'PaymentMethod',
                        'table_name' => 'user_addresses',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from user addresses table',
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
            // $processedCount = saveToDatabase($data, 'PaymentMethod');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                PaymentMethod::create([
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => !empty($item['title']) ? Str::slug($item['title']) : null,
                    'short_description' => !empty($item['short_description']) ? $item['short_description'] : null,
                    'long_description' => !empty($item['long_description']) ? $item['long_description'] : null,
                    'tags' => !empty($item['tags']) ? $item['tags'] : null,
                    'meta_title' => !empty($item['meta_title']) ? $item['meta_title'] : null,
                    'meta_desc' => !empty($item['meta_desc']) ? $item['meta_desc'] : null,
                    'position' => !empty($item['position']) ? $item['position'] : 1,
                    'status' => !empty($item['status']) ? $item['status'] : 0
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
                $fileName = "user_addresses_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new CartItemsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new CartItemsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new CartItemsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new CartItemsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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

    public function position(Array $ids)
    {
        try {
            foreach ($ids as $index => $id) {
                PaymentMethod::where('id', $id)->update([
                    'position' => $index + 1
                ]);
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Position updated'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while positioning data.',
                'error' => $e->getMessage(),
            ];
        }
    }
}
