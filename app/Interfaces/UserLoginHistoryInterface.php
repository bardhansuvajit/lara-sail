<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserLoginHistory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserLoginHistoryInterface
{
    public function exists(Array $conditions);
    public function store(Array $array);
    public function validateToken(String $token, Int $userId);
    public function getById(Int $id);
    public function update(Array $array);

    public function createLoginHistory(User $user, array $data): UserLoginHistory;
    public function updateLastActivity(string $token): bool;
    public function logoutSession(string $token, string $reason = null): bool;
    public function logoutAllSessions(int $userId, string $reason = null): bool;
    public function getActiveSessions(int $userId): Collection;
    public function getSessionsByPlatform(int $userId, string $platform): Collection;
    public function getRecentSessions(int $userId, int $days = 30): Collection;
    public function paginateUserSessions(int $userId, int $perPage = 15): LengthAwarePaginator;
    public function cleanupExpiredSessions(): int;
    public function getSessionByToken(string $token): ?UserLoginHistory;
    public function isTokenActive(string $token): bool;
}
