<?php

namespace App\Interfaces;

interface PaymentLogInterface
{
    public function log(array $data): array;
    public function getLogsByOrder(int $orderId, ?string $gateway = null): array;
}