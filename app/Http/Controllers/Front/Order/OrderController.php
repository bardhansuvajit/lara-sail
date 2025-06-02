<?php

namespace App\Http\Controllers\Front\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CartInterface;
use App\Interfaces\AddressInterface;
use App\Interfaces\OrderInterface;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    private CartInterface $cartRepository;
    private AddressInterface $addressRepository;
    private OrderInterface $orderRepository;

    public function __construct(
        CartInterface $cartRepository, 
        AddressInterface $addressRepository, 
        OrderInterface $orderRepository,
    )
    {
        $this->cartRepository = $cartRepository;
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'payment_method' => 'required|exists:payment_methods,id',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            // 'billing_address_id' => 'nullable|exists:user_addresses,id',
            'billing_address_id' => 'nullable'
        ]);

        // dd('here');

        DB::beginTransaction();

        try {
            $user = auth()->guard('web')->user();
            
            if (!$user) {
                return back()->with('error', 'Authentication required to place order.');
            }

            $deviceId = $_COOKIE['device_id'] ?? null;
            if (!$deviceId) {
                return back()->with('error', 'Device identification missing.');
            }

            // Get cart Data
            $cartResponse = $this->cartRepository->exists(['user_id' => $user->id]);
            if ($cartResponse['code'] != 200) {
                return back()->with('error', 'Invalid cart data.');
            }
            $cart = $cartResponse['data'];

            // Get Shipping Address Data
            $addressResponse = $this->addressRepository->exists([
                'id' => $validated['shipping_address_id'],
                'user_id' => $user->id,
                'address_type' => 'shipping',
            ]);

            if ($addressResponse['code'] != 200) {
                return back()->with('error', 'Invalid shipping address.');
            }
            $shippingAddress = json_encode($addressResponse['data'][0]);

            // Handle Billing Address
            $billingAddress = null;
            if (!empty($validated['billing_address_id'])) {
                $billingResponse = $this->addressRepository->exists([
                    'id' => $validated['billing_address_id'],
                    'user_id' => $user->id,
                    'address_type' => 'billing', // Fixed from 'shipping' to 'billing'
                ]);

                if ($billingResponse['code'] != 200) {
                    return back()->with('error', 'Invalid billing address.');
                }
                $billingAddress = json_encode($billingResponse['data'][0]);
            }

            // Prepare order data
            $orderData = [
                'cart_items' => $cart->items,

                'user_id' => $user->id,
                'user_first_name' => $user->first_name,
                'user_last_name' => $user->last_name,
                'device_id' => $cart->device_id,
                'email' => $user->email ?? null,
                'phone_no' => $user->primary_phone_no,

                'country' => $cart->country,
                'currency_code' => $cart->currency_code,

                'total_items' => $cart->total_items,
                'mrp' => $cart->mrp,
                'sub_total' => $cart->sub_total,
                'total' => $cart->total,

                'coupon_code_id' => $cart->coupon_code_id,
                'coupon_code' => $cart->coupon_code,
                'discount_amount' => $cart->discount_amount,
                'discount_type' => $cart->discount_type,

                'shipping_method_id' => $cart->shipping_method_id,
                'shipping_method_name' => $cart->shipping_method_name,
                'shipping_cost' => $cart->shipping_cost,
                'shipping_address' => $shippingAddress,

                'billing_address' => $billingAddress,
                'same_as_shipping' => $billingAddress === null,

                'tax_amount' => $cart->tax_amount,
                'tax_type' => $cart->tax_type,
                'tax_details' => $cart->tax_details,

                'payment_method_id' => $validated['payment_method'],
                'payment_method_title' => $cart->payment_method_title,
                'payment_method_charge' => $cart->payment_method_charge,
                'payment_method_discount' => $cart->payment_method_discount,
                'payment_status' => 'pending',
                'transaction_id' => null,
                'payment_details' => null,
            ];

            $orderResponse = $this->orderRepository->store($orderData);

            if ($orderResponse['code'] != 200) {
                throw new \Exception('Order creation failed');
            }

            DB::commit();

            // Store order ID in session for thank you page access control
            $request->session()->put('last_order_id', $orderResponse['data']->id);

            return redirect()->route('front.order.thankyou', ['orderId' => $orderResponse['data']->id])->with('success', 'Order placed successfully!');
            return redirect()->route('front.order.thankyou')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            logger()->channel('orders')->error('Order failed', [
                'user' => $user?->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Order failed. Our team has been notified.');
            // throw $th;
        }
    }

    public function thankyou(Request $request): View|RedirectResponse
    {
        $orderResponse = $this->orderRepository->getById($_GET['orderId']);
        return view('front.checkout.thankyou', [
            'order' => $orderResponse['data']
        ]);

        if (!$request->session()->has('last_order_id')) {
            return redirect()->route('front.home.index')->with('error', 'Invalid access to thank you page.');
        }

        $orderId = $request->session()->pull('last_order_id');

        // Optionally fetch order details to display
        $orderResponse = $this->orderRepository->getById($orderId);

        if ($orderResponse['code'] != 200) {
            return redirect()->route('front.home.index')->with('error', 'Order not found.');
        }

        return view('front.checkout.thankyou', [
            'order' => $orderResponse['data']
        ]);
    }
}
