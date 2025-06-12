<?php

namespace App\Repositories;

use App\Interfaces\CartItemInterface;
use App\Models\CartItem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

use App\Exports\CartItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class CartItemRepository implements CartItemInterface
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
            $query = CartItem::query();

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
        // dd($array['image']);
        try {
            $data = new CartItem();
            $data->cart_id = $array['cart_id'];
            $data->product_id = $array['product_id'];
            $data->product_title = !empty($array['product_title']) ? $array['product_title'] : null;
            $data->product_variation_id = !empty($array['product_variation_id']) ? $array['product_variation_id'] : null;
            $data->variation_attributes = !empty($array['variation_attributes']) ? $array['variation_attributes'] : null;
            $data->sku = !empty($array['sku']) ? $array['sku'] : null;
            $data->selling_price = !empty($array['selling_price']) ? $array['selling_price'] : 0;
            $data->mrp = !empty($array['mrp']) ? $array['mrp'] : 0;
            $data->quantity = !empty($array['quantity']) ? $array['quantity'] : 1;
            $data->total = !empty($array['total']) ? $array['total'] : 0;
            $data->product_url = !empty($array['product_url']) ? $array['product_url'] : null;
            $data->product_url_with_variation = !empty($array['product_url_with_variation']) ? $array['product_url_with_variation'] : null;
            $data->is_available = !empty($array['is_available']) ? $array['is_available'] : 1;
            $data->availability_message = !empty($array['availability_message']) ? $array['availability_message'] : 'In stock';
            $data->options = !empty($array['options']) ? $array['options'] : null;
            $data->custom_fields = !empty($array['custom_fields']) ? $array['custom_fields'] : null;

            $data->image_s = !empty($array['image_s']) ? $array['image_s'] : null;
            $data->image_m = !empty($array['image_m']) ? $array['image_m'] : null;
            $data->image_l = !empty($array['image_l']) ? $array['image_l'] : null;
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

    public function getById(Int $id)
    {
        try {
            $data = CartItem::with('cart', 'product')->find($id);

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
            $data = CartItem::with('cart', 'product')->where($conditions)->get();

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
                if (!empty($array['availability_message']))          $data['data']->availability_message = $array['availability_message'];
                $data['data']->is_available = $array['is_available'];

                $data['data']->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data,
                    'cart' => $data['data']->cart,
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

    public function updateAvailability(Array $conditions)
    {
        try {
            $data = $this->exists([
                'product_id' => $conditions['product_id']
            ]);

            if ($data['code'] != 200) {
                return [
                    'code' => $data['code'],
                    'status' => $data['status'],
                    'message' => 'Cart items not found for this product'
                ];
            }

            $cartItems = $data['data'];

            foreach($cartItems as $item) {
                $updated = $this->update([
                    'id' => $item->id,
                    'is_available' => $conditions['is_available'],
                    'availability_message' => $conditions['availability_message'],
                    'updated_at' => now()
                ]);

                return $updated;
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved'
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

    public function qtyUpdate(Array $array)
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

            $cartItem = $response['data'];
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
                $newQuantity = $cartItem->quantity + 1;
            } else {
                $newQuantity = $cartItem->quantity - 1;
                
                // Prevent going below minimum quantity (1)
                if ($newQuantity < 1) {
                    return [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Minimum cart quantity is 1',
                        'data' => $cartItem, // Return current item data
                    ];
                }
            }

            // Update item
            $cartItem->quantity = $newQuantity;
            $cartItem->total = $newQuantity * $cartItem->selling_price;
            $cartItem->save();

            // Return success response with updated data
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Quantity updated successfully.',
                'data' => $cartItem,
                'cart' => $cartItem->cart
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

    public function delete(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $cartItem = $data['data'];

                // dd($cartItem);

                // Handling trash
                $trashData = $this->trashRepository->store([
                    'model' => 'CartItem',
                    'table_name' => 'cart_items',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->product_title,
                    'description' => $data['data']->product_title.' & '. $data['data']->variation_attributes.' data deleted from cart items table',
                    'status' => 'deleted',
                ]);

                // dd($trashData);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $cartItem,
                    'cart' => $cartItem->cart
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

    public function saveForLater(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $cartItem = $data['data'];

                // dd($cartItem);

                // Update item
                $cartItem->is_saved_for_later = 1;
                $cartItem->quantity = 1;
                $cartItem->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $cartItem,
                    'cart' => $cartItem->cart
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

    public function moveToCart(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                $cartItem = $data['data'];

                // dd($cartItem);

                // Update item
                $cartItem->is_saved_for_later = 0;
                $cartItem->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $cartItem,
                    'cart' => $cartItem->cart
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

    public function bulkAction(Array $array)
    {
        try {
            $data = CartItem::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {

                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'CartItem',
                        'table_name' => 'cart_items',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from cart items table',
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
            // $processedCount = saveToDatabase($data, 'CartItem');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                CartItem::create([
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
                $fileName = "cart_items_export_" . date('Y-m-d') . '-' . time();

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
                CartItem::where('id', $id)->update([
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
