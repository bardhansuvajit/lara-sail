<?php

namespace App\Repositories;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Order;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentGatewayRepository implements PaymentGatewayInterface
{
    protected Api $api;
    protected string $key;
    protected string $secret;

    public function __construct()
    {
        $this->key = config('razorpay.key');
        $this->secret = config('razorpay.secret');
        $this->api = new Api($this->key, $this->secret);
    }

    // Create razorpay order and return payload for frontend
    public function createPayment(Order $order): array
    {
        // amount in smallest currency unit (paise)
        $amountPaise = intval(round($order->grand_total * 100)); // e.g. 199.50 -> 19950

        $orderData = [
            'receipt'         => 'order_rcpt_' . $order->id,
            'amount'          => $amountPaise,
            'currency'        => config('razorpay.currency', 'INR'),
            'payment_capture' => 1, // auto-capture
        ];

        $razorpayOrder = $this->api->order->create($orderData);

        return [
            'key' => $this->key,
            'order_id' => $razorpayOrder['id'],
            'amount' => $amountPaise,
            'currency' => $orderData['currency'],
            'name' => config('app.name'),
            'description' => 'Order #' . $order->id,
        ];
    }

    public function verifyPayment(array $payload): bool
    {
        // $payload must contain: razorpay_order_id, razorpay_payment_id, razorpay_signature
        if (!isset($payload['razorpay_order_id'], $payload['razorpay_payment_id'], $payload['razorpay_signature'])) {
            return false;
        }

        $data = $payload['razorpay_order_id'] . '|' . $payload['razorpay_payment_id'];
        $expectedSignature = hash_hmac('sha256', $data, $this->secret);

        return hash_equals($expectedSignature, $payload['razorpay_signature']);
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');
        $webhookSecret = config('razorpay.webhook_secret');

        if (!$webhookSecret || !$signature) {
            return response('missing signature', 400);
        }

        $expected = hash_hmac('sha256', $payload, $webhookSecret);

        if (!hash_equals($expected, $signature)) {
            Log::warning('Razorpay webhook verification failed.');
            return response('invalid signature', 400);
        }

        $body = json_decode($payload, true);
        // process $body['event'] like payment.captured, payment.failed, etc.
        // TODO: implement event handlers (mark order paid, refund, etc)

        return response('ok', 200);
    }
}
