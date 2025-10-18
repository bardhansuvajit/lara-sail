<?php

namespace App\Repositories;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Order;
use App\Models\PaymentGateway;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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

    // Show all payment gateways
    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = PaymentGateway::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('country_code', 'like', '%' . $keyword . '%')
                        ->orWhere('code', 'like', '%' . $keyword . '%')
                        ->orWhere('name', 'like', '%' . $keyword . '%')
                        ->orWhere('settings', 'like', '%' . $keyword . '%');
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

    // Create razorpay order and return payload for frontend
    public function createPayment(Order $order): array
    {
        // amount in smallest currency unit (paise)
        $amountPaise = intval(round($order->total * 100)); // e.g. 199.50 -> 19950

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

    public function handleWebhook(Request $request): \Illuminate\Http\Response
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
