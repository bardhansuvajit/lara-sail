<?php

namespace App\Http\Controllers\Front\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CartInterface;
use App\Interfaces\AddressInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\PaymentMethodInterface;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    private CartInterface $cartRepository;
    private AddressInterface $addressRepository;
    private OrderInterface $orderRepository;
    private PaymentGatewayInterface $paymentGatewayRepository;
    private PaymentMethodInterface $paymentMethodRepository;

    public function __construct(
        CartInterface $cartRepository,
        AddressInterface $addressRepository,
        OrderInterface $orderRepository,
        PaymentGatewayInterface $paymentGatewayRepository,
        PaymentMethodInterface $paymentMethodRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentGatewayRepository = $paymentGatewayRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function initiate(Request $request, $gatewayId)
    {
        // dd($request->all());

        $paymentMethodId = $request->get('payment_method_id');
        $shippingAddressId = $request->get('shipping_address_id');
        $billingAddressId = $request->get('billing_address_id');

        // Validate the parameters
        $validated = validator([
            'payment_method_id' => $paymentMethodId,
            'shipping_address_id' => $shippingAddressId,
            'billing_address_id' => $billingAddressId
        ], [
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            'billing_address_id' => 'nullable|exists:user_addresses,id'
        ])->validate();

        DB::beginTransaction();

        try {
            $user = auth()->guard('web')->user();

            if (!$user) {
                return back()->with('error', 'Authentication required.');
            }

            // Get cart data
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
                    'address_type' => 'billing',
                ]);

                if ($billingResponse['code'] == 200) {
                    $billingAddress = json_encode($billingResponse['data'][0]);
                }
            }

            // Payment Method details
            $paymentMethodId = $validated['payment_method_id'];
            $paymentMethodResponse = $this->paymentMethodRepository->getById($paymentMethodId);
            if ($paymentMethodResponse['code'] != 200) {
                return back()->with('error', 'Invalid Payment Method.');
            }
            $paymentMethodStatus = isset($paymentMethodResponse['data']->statuses[0])
                ? $paymentMethodResponse['data']->statuses[2]->slug
                : 'payment_processing';

            // dd($paymentMethodStatus);

            // Prepare order data (same as COD flow)
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
                'coupon_discount_amount' => $cart->coupon_discount_amount,
                'coupon_meta' => $cart->coupon_meta,

                'shipping_method_id' => $cart->shipping_method_id,
                'shipping_method_name' => $cart->shippingMethod->method,
                'shipping_cost' => $cart->shipping_cost,
                'shipping_address' => $shippingAddress,

                'billing_address' => $billingAddress,
                'same_as_shipping' => $billingAddress === null,

                'tax_amount' => $cart->tax_amount,
                'tax_type' => $cart->tax_type,
                'tax_details' => $cart->tax_details,

                'payment_method_id' => $validated['payment_method_id'],
                'payment_method_title' => $cart->payment_method_title,
                'payment_method_charge' => $cart->payment_method_charge,
                'payment_method_discount' => $cart->payment_method_discount,
                'payment_status' => $paymentMethodStatus,
                'transaction_id' => null,
                'payment_details' => null,

                'cart_meta' => json_encode($cart)
            ];

            // dd($orderData);

            // Create order first (just like COD)
            $orderResponse = $this->orderRepository->store($orderData);

            // dd($orderResponse);

            if ($orderResponse['code'] != 200) {
                throw new \Exception('Order creation failed');
            }

            $order = $orderResponse['data'];

            // Now initiate payment with the created order
            $paymentPayload = $this->paymentGatewayRepository->createPayment($order);

            DB::commit();

            // Store order ID in session for verification
            session(['current_order_id' => $order->id]);

            // Return to frontend with payment data
            return view('front.payment.razorpay.redirect', [
                'order' => $order,
                'paymentPayload' => $paymentPayload,
                'gatewayId' => $gatewayId
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            logger()->error('Payment initiation failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Payment initiation failed: ' . $e->getMessage());
        }
    }
}