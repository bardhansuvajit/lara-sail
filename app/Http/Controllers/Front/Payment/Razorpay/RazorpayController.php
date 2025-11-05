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
            // dd($request->all());
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
                    'payment_status' => 'payment_failed'
                ]);

                // Create failed payment record
                $order->payments()->create([
                    'gateway' => 'razorpay',
                    'gateway_payment_id' => $data['razorpay_payment_id'] ?? null,
                    'gateway_order_id' => $data['razorpay_order_id'] ?? null,
                    'amount' => $order->total,
                    'currency' => $order->currency_code ?? 'INR',
                    'status' => 'failed',
                    'meta' => array_merge($data, [
                        'failure_reason' => 'verification_failed',
                        'failed_at' => now()->toDateTimeString()
                    ]),
                ]);

                return response()->json([
                    'status' => false, 
                    'message' => 'Payment verification failed'
                ], 422);
            }

            DB::transaction(function() use ($order, $data) {
                // Update order payment status
                $order->update([
                    'payment_status' => 'payment_captured',
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
                // $order->update(['payment_status' => 'payment_captured']);
            });

            // Store order ID in session for thank you page access control
            $request->session()->put('last_order_number', $order->order_number);

            return response()->json([
                'status' => true, 
                'message' => 'Payment successful',
                'redirect_url' => route('front.order.thankyou', ['orderNumber' => $order->order_number])
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay verification error: ' . $e->getMessage());
            
            return response()->json([
                'status' => false, 
                'message' => 'Payment verification error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handleFail(Request $request)
    {
        try {
            $data = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'gateway_order_id' => 'nullable|string',
                'failure_reason' => 'required|string',
                'error_description' => 'nullable|string',
                'error_code' => 'nullable|string',
                'error_meta' => 'nullable|array'
            ]);

            $order = Order::findOrFail($data['order_id']);

            DB::transaction(function() use ($order, $data) {
                // Update order payment status based on failure reason
                $paymentStatus = $data['failure_reason'] === 'payment_process_discontinued' 
                    ? 'payment_process_discontinued' 
                    : 'payment_failed';

                $order->update([
                    'payment_status' => $paymentStatus
                ]);

                // Create failed payment record
                $order->payments()->create([
                    'gateway' => 'razorpay',
                    'gateway_payment_id' => null,
                    'gateway_order_id' => $data['gateway_order_id'] ?? null,
                    'amount' => $order->total,
                    'currency' => $order->currency_code ?? 'INR',
                    'status' => 'failed',
                    'meta' => array_merge($data, [
                        'failed_at' => now()->toDateTimeString()
                    ]),
                ]);
            });

            return response()->json([
                'status' => true, 
                'message' => 'Payment failure recorded successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay payment failure recording error: ' . $e->getMessage());
            
            return response()->json([
                'status' => false, 
                'message' => 'Failed to record payment failure'
            ], 500);
        }
    }

    /*
    public function webhook(Request $request)
    {
        return $this->gateway->handleWebhook($request);
    }
    */

    public function webhook(Request $request)
    {
        try {
            // Razorpay webhook for payment failures
            $webhookBody = $request->getContent();
            $webhookSignature = $request->header('X-Razorpay-Signature');

            if (!$this->gateway->verifyWebhookSignature($webhookBody, $webhookSignature)) {
                \Log::error('Razorpay webhook signature verification failed');
                return response()->json(['status' => 'invalid signature'], 400);
            }

            // Verify webhook signature
            // if ($this->gateway->verifyWebhookSignature($webhookBody, $webhookSignature)) {
                $data = json_decode($webhookBody, true);

                if ($data['event'] === 'payment.failed') {
                    $payment = $data['payload']['payment']['entity'];

                    // Find order by gateway_order_id or gateway_payment_id
                    $order = Order::where('gateway_order_id', $payment['order_id'])
                                ->orWhere('transaction_id', $payment['id'])
                                ->first();

                    if ($order) {
                        DB::transaction(function() use ($order, $payment) {
                            $order->update([
                                'payment_status' => 'payment_failed'
                            ]);

                            $order->payments()->create([
                                'gateway' => 'razorpay',
                                'gateway_payment_id' => $payment['id'],
                                'gateway_order_id' => $payment['order_id'],
                                'amount' => $payment['amount'] / 100,
                                'currency' => $payment['currency'],
                                'status' => 'failed',
                                'meta' => [
                                    'failure_reason' => $payment['error_reason'] ?? 'unknown',
                                    'error_code' => $payment['error_code'] ?? 'unknown',
                                    'error_description' => $payment['error_description'] ?? 'Payment failed',
                                    'failed_via' => 'webhook',
                                    'failed_at' => now()->toDateTimeString()
                                ],
                            ]);
                        });
                    }
                }
            // }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Webhook error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

}
