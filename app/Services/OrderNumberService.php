<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderNumberService
{
    const PREFIX = 'CMPNY';
    const TEST_IDENTIFIER = 'TEST';
    const NORMAL_IDENTIFIER = 'ORD';
    const NUMBER_LENGTH = 6;

    public function generate(?string $email = null, ?string $firstName = null, ?string $lastName = null): string
    {
        $isTestOrder = $this->isTestOrder($email, $firstName, $lastName);
        $sequenceNumber = $this->getNextSequenceNumber($isTestOrder);

        return $this->formatOrderNumber($isTestOrder, $sequenceNumber);
    }

    protected function isTestOrder(?string $email, ?string $firstName, ?string $lastName): bool
    {
        return ($email && Str::contains(strtolower($email), 'test')) ||
            ($firstName && Str::contains(strtolower($firstName), 'test')) ||
            ($lastName && Str::contains(strtolower($lastName), 'test'));
    }

    protected function getNextSequenceNumber(bool $isTestOrder): int
    {
        $identifier = $isTestOrder ? self::TEST_IDENTIFIER : self::NORMAL_IDENTIFIER;
        $pattern = self::PREFIX . '-' . $identifier . '-%';

        $lastOrder = Order::where('order_number', 'like', $pattern)
            ->orderByRaw('LENGTH(order_number) DESC')
            ->orderBy('order_number', 'DESC')
            ->first();

        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->order_number, -self::NUMBER_LENGTH);
            return $lastNumber + 1;
        }

        return 1;
    }

    protected function formatOrderNumber(bool $isTestOrder, int $sequenceNumber): string
    {
        $identifier = $isTestOrder ? self::TEST_IDENTIFIER : self::NORMAL_IDENTIFIER;
        $paddedNumber = str_pad($sequenceNumber, self::NUMBER_LENGTH, '0', STR_PAD_LEFT);

        return sprintf('%s-%s-%s', self::PREFIX, $identifier, $paddedNumber);
    }
}