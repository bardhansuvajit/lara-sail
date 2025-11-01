<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\UserLoginHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserLoginHistoryService
{
    public function __construct(
        private UserLoginHistoryInterface $repository
    ) {}

    public function recordLogin(User $user, string $token, array $additionalData = []): void
    {
        $data = array_merge([
            'token' => $token,
            'ip_address' => request()->ip(),
            'platform' => $this->detectPlatform(),
        ], $additionalData);

        // Add location data if available
        if ($location = $this->getLocationData()) {
            $data = array_merge($data, $location);
        }

        $this->repository->createLoginHistory($user, $data);
    }

    public function updateActivity(string $token): void
    {
        $this->repository->updateLastActivity($token);
    }

    public function logoutSession(string $token, string $reason = 'user'): void
    {
        $this->repository->logoutSession($token, $reason);
    }

    public function logoutFromAllDevices(User $user, string $reason = 'user'): void
    {
        $this->repository->logoutAllSessions($user->id, $reason);
    }

    public function getActiveSessions(int $userId): Collection
    {
        return $this->repository->getActiveSessions($userId);
    }

    public function getRecentSessions(int $userId, int $days = 30): Collection
    {
        return $this->repository->getRecentSessions($userId, $days);
    }

    public function getSessionsByPlatform(int $userId, string $platform): Collection
    {
        return $this->repository->getSessionsByPlatform($userId, $platform);
    }

    public function paginateUserSessions(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateUserSessions($userId, $perPage);
    }

    public function getSessionByToken(string $token)
    {
        return $this->repository->getSessionByToken($token);
    }

    public function isTokenActive(string $token): bool
    {
        return $this->repository->isTokenActive($token);
    }

    public function cleanupExpiredSessions(): int
    {
        return $this->repository->cleanupExpiredSessions();
    }

    private function detectPlatform(): string
    {
        $userAgent = strtolower(request()->userAgent() ?? '');

        if (str_contains($userAgent, 'iphone') || str_contains($userAgent, 'ipad')) {
            return 'ios';
        }
        
        if (str_contains($userAgent, 'android')) {
            return 'android';
        }
        
        if (str_contains($userAgent, 'tablet')) {
            return 'tablet';
        }
        
        if (str_contains($userAgent, 'mobile')) {
            return 'mobile_web';
        }
        
        return 'web';
    }

    private function getLocationData(): ?array
    {
        // For now, return basic IP-based data
        // You can enhance this later with IP geolocation APIs
        $ip = request()->ip();
        
        // Skip local IPs
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return null;
        }
        
        return [
            'ip_address' => $ip,
            // These can be populated later with geolocation services
            'latitude' => null,
            'longitude' => null,
            'city' => null,
            'country' => null,
        ];
    }
}