<?php

namespace App\Repositories;

use App\Interfaces\WishlistInterface;
use App\Models\ProductWishlist;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use Illuminate\Database\Eloquent\Collection;

use App\Exports\WishlistsExport;
use Maatwebsite\Excel\Facades\Excel;

class WishlistRepository implements WishlistInterface
{
    private TrashInterface $trashRepository;

    public function __construct(
        TrashInterface $trashRepository
    )
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductWishlist::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('order_number', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('phone_no', 'like', '%' . $keyword . '%')
                        ->orWhere('currency_code', 'like', '%' . $keyword . '%')
                        ->orWhere('mrp', 'like', '%' . $keyword . '%')
                        ->orWhere('sub_total', 'like', '%' . $keyword . '%')
                        ->orWhere('total', 'like', '%' . $keyword . '%')
                        ->orWhere('coupon_code', 'like', '%' . $keyword . '%')
                        ->orWhere('shipping_address', 'like', '%' . $keyword . '%')
                        ->orWhere('billing_address', 'like', '%' . $keyword . '%')
                        ->orWhere('payment_method_title', 'like', '%' . $keyword . '%')
                        ->orWhere('payment_status', 'like', '%' . $keyword . '%')
                        ->orWhere('status', 'like', '%' . $keyword . '%');
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
        DB::beginTransaction();

        try {
            // Get the highest current position for this user
            $maxPosition = ProductWishlist::where('user_id', $array['user_id'])
                                    ->max('position') ?? 0;

            $data = new ProductWishlist();
            $data->product_id = $array['product_id'];
            $data->user_id = $array['user_id'];
            $data->position = $maxPosition + 1;
            $data->status = 1;

            $data->save();

            DB::commit();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Item added to Wishlist',
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
            $data = ProductWishlist::with('user', 'product')->find($id);

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

    public function checkStatus(Array $productIds, Int $userId)
    {
        try {
            $data = ProductWishlist::with('user', 'product')->where('user_id', $userId)
                    ->whereIn('product_id', $productIds)
                    ->pluck('product_id')
                    ->toArray();

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
            $data = ProductWishlist::with('user', 'product')->where($conditions)->get();

            if (count($data) > 0 ) {
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
                if (isset($array['type'])) {
                    if ($array['type'] == "asc") {
                        $data['data']->quantity += 1;
                    } else {
                        $data['data']->quantity -= 1;
                    }
                }

                if (isset($array['user_id']))       $data['data']->user_id = $array['user_id'];
                

                // $data['data']->title = $array['title'];
                // $data['data']->slug = \Str::slug($array['title']);

                // if (!empty($array['image'])) {
                //     $uploadResp = fileUpload($array['image'], 'p-clt');

                //     $data['data']->image_s = $uploadResp['smallThumbName'];
                //     $data['data']->image_m = $uploadResp['mediumThumbName'];
                //     $data['data']->image_l = $uploadResp['largeThumbName'];
                // }

                $data['data']->save();

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
                    'model' => 'ProductWishlist',
                    'table_name' => 'product_wishlists',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => null,
                    'title' => 'Wishlist',
                    'description' => 'Wishlist data deleted from product_wishlists table',
                    'status' => 'deleted',
                ]);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Item removed from Wishlist',
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
            $data = ProductWishlist::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {

                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'ProductWishlist',
                        'table_name' => 'product_wishlists',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => null,
                        'title' => $item->order_number,
                        'description' => $item->order_number.' data deleted from product_wishlists table',
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
            // $processedCount = saveToDatabase($data, 'ProductWishlist');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                ProductWishlist::create([
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
                $fileName = "carts_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new WishlistsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new WishlistsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new WishlistsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new WishlistsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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
