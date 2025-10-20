<?php

namespace App\Http\Controllers\Front\Payment\Razorpay;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentGatewayRepository;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RazorpayController extends Controller
{
    protected PaymentGatewayRepository $gateway;

    public function __construct(PaymentGatewayRepository $gateway)
    {
        $this->gateway = $gateway;
    }

    public function createOrder(Request $request)
    {
        $order = Order::findOrFail($request->input('order_id'));

        $payload = $this->gateway->createPayment($order);

        // store Razorpay order_id in DB
        $order->update(['gateway_order_id' => $payload['order_id']]);

        return response()->json($payload);
    }

    public function verify(Request $request)
    {
        try {
            $data = $request->only(['razorpay_order_id','razorpay_payment_id','razorpay_signature','order_id']);
            
            // Validate required fields
            $validator = validator($data, [
                'razorpay_order_id' => 'required',
                'razorpay_payment_id' => 'required', 
                'razorpay_signature' => 'required',
                'order_id' => 'required|exists:orders,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Invalid verification data'
                ], 422);
            }

            $order = Order::findOrFail($data['order_id']);

            $isValid = $this->gateway->verifyPayment($data);

            if (!$isValid) {
                // Update order status to failed
                $order->update([
                    'payment_status' => 'failed'
                ]);

                return response()->json([
                    'status' => false, 
                    'message' => 'Payment verification failed'
                ], 422);
            }

            DB::transaction(function() use ($order, $data) {
                // Update order payment status
                $order->update([
                    'payment_status' => 'captured',
                    'transaction_id' => $data['razorpay_payment_id'],
                    'paid_at' => now(),
                ]);

                // Create payment record
                $order->payments()->create([
                    'gateway' => 'razorpay',
                    'gateway_payment_id' => $data['razorpay_payment_id'],
                    'gateway_order_id' => $data['razorpay_order_id'],
                    'amount' => $order->total, // Use the appropriate total field
                    'currency' => $order->currency_code ?? 'INR',
                    'meta' => $data,
                ]);

                // You might also want to update order status
                $order->update(['status' => 'confirmed']);
            });

            return response()->json([
                'status' => true, 
                'message' => 'Payment successful',
                'redirect_url' => route('front.order.thankyou', ['orderId' => $order->id])
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay verification error: ' . $e->getMessage());
            
            return response()->json([
                'status' => false, 
                'message' => 'Payment verification error: ' . $e->getMessage()
            ], 500);
        }
    }

    /*
    public function verify(Request $request)
    {
        $data = $request->only(['razorpay_order_id','razorpay_payment_id','razorpay_signature','order_id']);
        $order = Order::findOrFail($data['order_id']);

        $isValid = $this->gateway->verifyPayment($data);

        if (!$isValid) {
            return response()->json(['status' => false, 'message' => 'Verification failed'], 422);
        }

        DB::transaction(function() use ($order, $data) {
            $order->update([
                'payment_status' => 'paid',
                'payment_method' => 'razorpay',
                'paid_at' => now(),
            ]);

            $order->payments()->create([
                'gateway' => 'razorpay',
                'gateway_payment_id' => $data['razorpay_payment_id'],
                'gateway_order_id' => $data['razorpay_order_id'],
                'amount' => $order->grand_total,
                'meta' => json_encode($data),
            ]);
        });

        return response()->json(['status' => true, 'message' => 'Payment successful']);
    }
    */

    public function webhook(Request $request)
    {
        return $this->gateway->handleWebhook($request);
    }
}
