<?php

namespace App\Interfaces;
use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    // Show all payment gateways
    public function list(?String $keyword, Array $filters = [], String $perPage, String $sortBy, String $sortOrder);

    // Return array used by frontend to initialize checkout (order_id, key, amount, currency, etc)
    public function createPayment(Order $order): array;

    // Verify payment after frontend returns success
    public function verifyPayment(array $payload): bool;

    // Optionally: webhook handler payload processing
    public function handleWebhook(Request $request): \Illuminate\Http\Response;
}
