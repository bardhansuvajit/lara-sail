<?php

namespace App\Repositories;

use App\Interfaces\PaymentLogInterface;
use App\Models\PaymentLog;
use Illuminate\Support\Facades\DB;

class PaymentLogRepository implements PaymentLogInterface
{
    public function log(array $data): array
    {
        try {
            $log = PaymentLog::create([
                'order_id' => $data['order_id'],
                'gateway' => $data['gateway'] ?? 'razorpay',
                'type' => $data['type'], // request, response, webhook, callback
                'action' => $data['action'], // create_order, verify, fail, webhook
                'request_data' => $data['request_data'] ?? null,
                'response_data' => $data['response_data'] ?? null,
                'http_status' => $data['http_status'] ?? null,
                'ip_address' => $data['ip_address'] ?? request()->ip(),
                'user_agent' => $data['user_agent'] ?? request()->userAgent(),
                'notes' => $data['notes'] ?? null,
            ]);

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Payment log created',
                'data' => $log,
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Failed to create payment log',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getLogsByOrder(int $orderId, ?string $gateway = null): array
    {
        try {
            $query = PaymentLog::where('order_id', $orderId);
            
            if ($gateway) {
                $query->where('gateway', $gateway);
            }

            $logs = $query->orderBy('created_at', 'desc')->get();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Payment logs retrieved',
                'data' => $logs,
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Failed to retrieve payment logs',
                'error' => $e->getMessage(),
            ];
        }
    }
}