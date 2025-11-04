<?php

namespace App\Repositories;

use App\Interfaces\OrderItemInterface;
use App\Models\OrderItem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

use App\Exports\OrderItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderItemRepository implements OrderItemInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = OrderItem::query();

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

    public function store(array $array)
    {
        // dd($array['image']);
        try {
            $data = new OrderItem();
            $data->order_id = $array['order_id'];
            $data->product_id = $array['product_id'];
            $data->product_variation_id = !empty($array['product_variation_id']) ? $array['product_variation_id'] : null;
            $data->product_title = !empty($array['product_title']) ? $array['product_title'] : null;
            $data->variation_attributes = !empty($array['variation_attributes']) ? $array['variation_attributes'] : null;
            $data->product_sku = !empty($array['product_sku']) ? $array['product_sku'] : null;
            $data->product_url = !empty($array['product_url']) ? $array['product_url'] : null;
            $data->product_url_with_variation = !empty($array['product_url_with_variation']) ? $array['product_url_with_variation'] : null;

            $data->image_s = !empty($array['image_s']) ? $array['image_s'] : null;
            $data->image_m = !empty($array['image_m']) ? $array['image_m'] : null;
            $data->image_l = !empty($array['image_l']) ? $array['image_l'] : null;

            $data->selling_price = !empty($array['selling_price']) ? $array['selling_price'] : 0;
            $data->mrp = !empty($array['mrp']) ? $array['mrp'] : 0;
            $data->quantity = !empty($array['quantity']) ? $array['quantity'] : 1;
            $data->total = !empty($array['total']) ? $array['total'] : 0;

            $data->tax_amount = !empty($array['tax_amount']) ? $array['tax_amount'] : 0;
            $data->tax_type = !empty($array['tax_type']) ? $array['tax_type'] : 0;
            $data->tax_details = !empty($array['tax_details']) ? $array['tax_details'] : 0;

            $data->cart_availability_message = !empty($array['cart_availability_message']) ? $array['cart_availability_message'] : 'In stock';
            $data->status = !empty($array['status']) ? $array['status'] : 'Pending';
            $data->status_notes = !empty($array['status_notes']) ? $array['status_notes'] : null;
            $data->custom_fields = !empty($array['custom_fields']) ? $array['custom_fields'] : null;

            $data->save();

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

    public function getById(int $id)
    {
        try {
            $data = OrderItem::with('order')
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

    public function update(array $array)
    {
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                if (isset($array['type'])) {
                    if ($array['type'] == "asc") {
                        $data['data']->quantity += 1;
                    } elseif ($array['type'] == "desc") {
                        $data['data']->quantity -= 1;
                    } else {
                        return [
                            'code' => 500,
                            'status' => 'error',
                            'message' => 'An error occurred while updating data.'
                        ];
                    }
                }

                if (!empty($array['quantity']))         $data['data']->quantity = $array['quantity'];
                if (!empty($array['total']))            $data['data']->total = $array['total'];
                if (!empty($array['image_s']))          $data['data']->image_s = $array['image_s'];
                if (!empty($array['image_m']))          $data['data']->image_m = $array['image_m'];
                if (!empty($array['image_l']))          $data['data']->image_l = $array['image_l'];

                $data['data']->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data,
                    'order' => $data['data']->order,
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

    public function qtyUpdate(array $array)
    {
        try {
            if (!isset($array['id']) || !isset($array['type'])) {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Missing required parameters (id or type).',
                ];
            }

            $response = $this->getById($array['id']);

            if ($response['code'] != 200) {
                return $response;
            }

            $orderItem = $response['data'];
            $type = $array['type'];

            // Validate quantity update type
            if (!in_array($type, ['asc', 'desc'])) {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Invalid update type. Must be "asc" or "desc".',
                ];
            }

            // Calculate new quantity (ensure it doesn't go below 0)
            if ($type == 'asc') {
                $newQuantity = $orderItem->quantity + 1;
            } else {
                $newQuantity = $orderItem->quantity - 1;
                
                // Prevent going below minimum quantity (1)
                if ($newQuantity < 1) {
                    return [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Minimum order quantity is 1',
                        'data' => $orderItem, // Return current item data
                    ];
                }
            }

            // Update item
            $orderItem->quantity = $newQuantity;
            $orderItem->total = $newQuantity * $orderItem->selling_price;
            $orderItem->save();

            // Return success response with updated data
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Quantity updated successfully.',
                'data' => $orderItem,
                'order' => $orderItem->order
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function delete(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $orderItem = $data['data'];

                // dd($orderItem);

                // Handling trash
                $trashData = $this->trashRepository->store([
                    'model' => 'OrderItem',
                    'table_name' => 'order_items',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->product_title,
                    'description' => $data['data']->product_title.' & '. $data['data']->variation_attributes.' data deleted from order items table',
                    'status' => 'deleted',
                ]);

                // dd($trashData);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $orderItem,
                    'order' => $orderItem->order
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

    public function saveForLater(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $orderItem = $data['data'];

                // dd($orderItem);

                // Update item
                $orderItem->is_saved_for_later = 1;
                $orderItem->quantity = 1;
                $orderItem->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $orderItem,
                    'order' => $orderItem->order
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

    public function moveToCart(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $orderItem = $data['data'];

                // dd($orderItem);

                // Update item
                $orderItem->is_saved_for_later = 0;
                $orderItem->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $orderItem,
                    'order' => $orderItem->order
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

    public function bulkAction(array $array)
    {
        try {
            $data = OrderItem::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {

                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'OrderItem',
                        'table_name' => 'order_items',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from order items table',
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
            // $processedCount = saveToDatabase($data, 'OrderItem');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                OrderItem::create([
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

    public function export(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "order_items_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new OrderItemsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new OrderItemsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new OrderItemsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new OrderItemsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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

    public function position(array $ids)
    {
        try {
            foreach ($ids as $index => $id) {
                OrderItem::where('id', $id)->update([
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
