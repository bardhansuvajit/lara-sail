<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Cart;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\CartSettingInterface;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\ShippingMethodInterface;

use App\Exports\CartsExport;
use Maatwebsite\Excel\Facades\Excel;

class CartRepository implements CartInterface
{
    private TrashInterface $trashRepository;
    private CartSettingInterface $cartSettingRepository;
    private PaymentMethodInterface $paymentMethodRepository;
    private ShippingMethodInterface $shippingMethodRepository;

    public function __construct(
        TrashInterface $trashRepository, 
        CartSettingInterface $cartSettingRepository, 
        PaymentMethodInterface $paymentMethodRepository,
        ShippingMethodInterface $shippingMethodRepository
    )
    {
        $this->trashRepository = $trashRepository;
        $this->cartSettingRepository = $cartSettingRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->shippingMethodRepository = $shippingMethodRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = Cart::query();

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
        try {
            $data = Cart::firstOrCreate([
                'device_id' => !empty($array['device_id']) ? $array['device_id'] : null,
                'user_id' => !empty($array['user_id']) ? $array['user_id'] : null
            ]);

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
            $data = Cart::find($id);

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
            $data = Cart::with('items', 'savedItems')->where($conditions)->first();

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

    public function updateCartTotals($cart)
    {
        try {
            // Calculate item totals
            $itemsTotal = $cart->items()->sum('total');
            $itemsQuantity = $cart->items()->sum('quantity');

            // $totalMrp = 0;
            // foreach ($cart->items as $itemKey => $itemValue) {
            //     $price = $itemValue->mrp;
            //     if ($price == 0) $price = $itemValue->selling_price;
            //     $totalPrice = $price * $itemValue->quantity;
            //     $totalMrp += $totalPrice;
            // }

            $totalMrp = $cart->items->sum(function ($item) {
                $price = $item->mrp > 0 ? $item->mrp : $item->selling_price;
                return $price * $item->quantity;
            });


            // Calculate shipping cost
            $shippingCost = $this->calculateShippingCost($cart, $itemsTotal);

            // Calculate payment method adjustments
            $paymentDetails = $this->calculatePaymentMethodAdjustments($itemsTotal, $shippingCost);

            // Update cart totals
            $cart->update([
                'total_items' => $itemsQuantity,
                'mrp' => $totalMrp,
                'sub_total' => $itemsTotal,
                'shipping_cost' => $shippingCost,
                'payment_method_id' => $paymentDetails['id'],
                'payment_method_title' => $paymentDetails['title'],
                'payment_method_charge' => $paymentDetails['charge'],
                'payment_method_discount' => $paymentDetails['discount'],
                'total' => $paymentDetails['grandTotal'],
                'last_activity_at' => now(),
            ]);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Cart totals updated successfully.',
                'data' => [
                    'cart' => $cart,
                    'items' => $cart->items
                ],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating the cart totals.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updatePaymentMethod(int $id, Int $cartId)
    {
        try {
            $cart = $this->getById($cartId);

            if (!$cart) {
                return [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Cart not found.',
                ];
            }

            $cart = $cart['data'];

            // Get current cart values
            $itemsTotal = $cart->sub_total;
            $shippingCost = $cart->shipping_cost;

            // Get payment method details
            $paymentMethod = $this->paymentMethodRepository->getById($id);

            if (!$paymentMethod['code'] == 200 || $paymentMethod['data']->status != 1) {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Invalid payment method.',
                ];
            }

            // Calculate payment method adjustments
            $paymentDetails = $this->calculatePaymentAdjustments(
                $itemsTotal, 
                $shippingCost, 
                $paymentMethod['data']
            );

            // Update cart with new payment method details
            $cart->update([
                'payment_method_id' => $paymentMethod['data']->id,
                'payment_method_title' => $paymentDetails['title'],
                'payment_method_charge' => $paymentDetails['charge'],
                'payment_method_discount' => $paymentDetails['discount'],
                'total' => $paymentDetails['grandTotal'],
                'last_activity_at' => now(),
            ]);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Payment method updated successfully.',
                'data' => [
                    'cart' => $cart,
                    'payment_details' => $paymentDetails
                ],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating payment method.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updateShippingMethod(int $id, Int $cartId)
    {
        try {
            $cart = $this->getById($cartId);

            if (!$cart) {
                return [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Cart not found.',
                ];
            }

            $cart = $cart['data'];

            // Get Shipping data
            $shippingMethodData = $this->shippingMethodRepository->getById($id);

            if (!$shippingMethodData['code'] == 200 || $shippingMethodData['data']->status != 1) {
                return [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Invalid shipping method.',
                ];
            }

            $shippingMethodData = $shippingMethodData['data'];
            $shippingMethodCost = $cart->shipping_cost + $shippingMethodData->cost;
            $newTotal = $cart->total + $shippingMethodCost;

            // Update cart with new payment method details
            $cart->update([
                'shipping_method_id' => $id,
                'shipping_cost' => $shippingMethodCost,
                'total' => $newTotal,
                'last_activity_at' => now(),
            ]);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Shipping method updated successfully.',
                'data' => [
                    'cart' => $cart,
                    'payment_details' => $paymentDetails
                ],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating payment method.',
                'error' => $e->getMessage(),
            ];
        }
    }

    protected function calculatePaymentAdjustments(float $itemsTotal, float $shippingCost, object $paymentMethod): array
    {
        $adjustment = 0;
        $title = null;
        $isCharge = false;

        if ($paymentMethod->charge_amount > 0) {
            $adjustment = $this->calculateAdjustment(
                $itemsTotal,
                $paymentMethod->charge_amount,
                $paymentMethod->charge_type
            );
            $title = $paymentMethod->charge_title;
            $isCharge = true;
        } elseif ($paymentMethod->discount_amount > 0) {
            $adjustment = $this->calculateAdjustment(
                $itemsTotal,
                $paymentMethod->discount_amount,
                $paymentMethod->discount_type
            );
            $title = $paymentMethod->discount_title;
            $isCharge = false;
        }

        return [
            'title' => $title,
            'charge' => $isCharge ? $adjustment : 0,
            'discount' => $isCharge ? 0 : $adjustment,
            'grandTotal' => $itemsTotal + ($isCharge ? $adjustment : -$adjustment) + $shippingCost
        ];
    }

    protected function calculateShippingCost($cart, $itemsTotal): float
    {
        $cartSettingResp = $this->cartSettingRepository->list('', [], 'all', 'id', 'asc');
        $cartSettings = $cartSettingResp['data'] ?? [];

        foreach ($cartSettings as $cartSetting) {
            if ($cartSetting->country === $cart->country 
                && $itemsTotal < $cartSetting->free_shipping_threshold) {
                return (float) $cartSetting->shipping_charge;
            }
        }

        return 0.0;
    }

    protected function calculatePaymentMethodAdjustments(float $itemsTotal, float $shippingCost): array
    {
        $paymentMethodData = $this->paymentMethodRepository->list('', [
            'status' => 1, 
            'country_code' => COUNTRY['country']
        ], 'all', 'position', 'asc')['data'][0] ?? null;

        if (!$paymentMethodData) {
            return [
                'id' => null,
                'title' => null,
                'charge' => 0,
                'discount' => 0,
                'grandTotal' => $itemsTotal + $shippingCost
            ];
        }

        $adjustment = 0;
        $id = null;
        $title = null;
        $isCharge = false;

        if ($paymentMethodData->charge_amount > 0) {
            $adjustment = $this->calculateAdjustment(
                $itemsTotal,
                $paymentMethodData->charge_amount,
                $paymentMethodData->charge_type
            );
            $id = $paymentMethodData->id;
            $title = $paymentMethodData->charge_title;
            $isCharge = true;
        } elseif ($paymentMethodData->discount_amount > 0) {
            $adjustment = $this->calculateAdjustment(
                $itemsTotal,
                $paymentMethodData->discount_amount,
                $paymentMethodData->discount_type
            );
            $id = $paymentMethodData->id;
            $title = $paymentMethodData->discount_title;
            $isCharge = false;
        }

        return [
            'id' => $id,
            'title' => $title,
            'charge' => $isCharge ? $adjustment : 0,
            'discount' => $isCharge ? 0 : $adjustment,
            'grandTotal' => $itemsTotal + ($isCharge ? $adjustment : -$adjustment) + $shippingCost
        ];
    }

    protected function calculateAdjustment(float $amount, float $adjustmentValue, string $type): float
    {
        return $type === 'fixed' 
            ? $adjustmentValue 
            : ($amount * $adjustmentValue) / 100;
    }

    public function delete(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'Cart',
                    'table_name' => 'carts',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->product_title,
                    'description' => $data['data']->product_title.' & '. $data['data']->variation_attributes.' data deleted from carts table',
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
            $data = Cart::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {

                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'Cart',
                        'table_name' => 'carts',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from carts table',
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
            // $processedCount = saveToDatabase($data, 'Cart');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                Cart::create([
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
                    return Excel::download(new CartsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new CartsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new CartsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new CartsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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
                Cart::where('id', $id)->update([
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
