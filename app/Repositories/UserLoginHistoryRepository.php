<?php

namespace App\Repositories;

use App\Interfaces\UserLoginHistoryInterface;
use App\Models\UserLoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\TrashInterface;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserLoginHistoryRepository implements UserLoginHistoryInterface
{
    private TrashInterface $trashRepository;
    private Request $request;

    public function __construct(TrashInterface $trashRepository, Request $request)
    {
        $this->trashRepository = $trashRepository;
        $this->request = $request;
    }

    public function exists(array $conditions)
    {
        try {
            $records = UserLoginHistory::where($conditions)->get();

            if (count($records) > 0) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $records,
                ];
            } else {
                return [
                    'code' => 401,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function store(array $array)
    {
        try {
            // UPDATE OTHER MATCHES
            $dataExists = $this->exists([
                'user_id' => $array['user_id']
            ]);

            if ($dataExists['code'] == 200) {
                foreach($dataExists['data'] as $toUpdateData) {
                    if ($toUpdateData->is_active == 1) {
                        $this->update([
                            'id' => $toUpdateData->id,
                            'is_active' => 0,
                            'last_activity_at' => now(),
                            'expires_at' => now(),
                            'logout_reason' => 'update existing token sessions to login with current session',
                        ]);
                    }
                }
            }

            // STORE
            $data = new UserLoginHistory();
            $data->user_id = $array['user_id'];
            $data->token = $array['token'];
            $data->platform = $array['platform'] ?? null;
            $data->device_type = $array['device_type'] ?? null;
            $data->device_brand = $array['device_brand'] ?? null;
            $data->device_model = $array['device_model'] ?? null;
            $data->os_name = $array['os_name'] ?? null;
            $data->os_version = $array['os_version'] ?? null;
            $data->browser = $array['browser'] ?? null;
            $data->browser_version = $array['browser_version'] ?? null;
            $data->app_version = $array['app_version'] ?? null;
            $data->latitude = $array['latitude'] ?? null;
            $data->longitude = $array['longitude'] ?? null;
            $data->ip_address = $array['ip_address'] ?? null;
            $data->city = $array['city'] ?? null;
            $data->country = $array['country'] ?? null;
            $data->payload = $array['payload'] ?? null;
            $data->login_at = $array['login_at'] ?? now();
            $data->last_activity_at = $array['last_activity_at'] ?? now();
            $data->save();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $data,
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function validateToken(String $token, int $userId)
    {
        try {
            $record = UserLoginHistory::where('user_id', $userId)
                ->where('is_active', 1)
                ->first();

            if (!$record || !Hash::check($token, $record->token)) {
                return [
                    'code' => 401,
                    'status' => 'failure',
                    'message' => 'Invalid token',
                ];
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Token valid',
                'data' => $record,
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

    public function getById(int $id)
    {
        try {
            $data = UserLoginHistory::find($id);

            if (!empty($data)) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            } else {
                return [
                    'code' => 404,
                    'status' => 'failure',
                    'message' => 'No data found',
                    'data' => [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function update(array $array)
    {
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                $data['data']->is_active = $array['is_active'] ?? $data['data']->is_active;
                $data['data']->last_activity_at = $array['last_activity_at'] ?? $data['data']->last_activity_at;
                $data['data']->expires_at = $array['expires_at'] ?? $data['data']->expires_at;
                $data['data']->logout_reason = $array['logout_reason'] ?? $data['data']->logout_reason;
                $data['data']->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data,
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function createLoginHistory(User $user, array $data): UserLoginHistory
    {
        // Parse user agent if not provided
        if (empty($data['user_agent']) && $this->request->userAgent()) {
            $parsedData = $this->parseUserAgent();
            $data['user_agent'] = $parsedData;
            $data['platform'] = $data['platform'] ?? $this->detectPlatform();
            $data['device_type'] = $data['device_type'] ?? $parsedData['device_type'] ?? null;
            $data['os_name'] = $data['os_name'] ?? $parsedData['os_name'] ?? null;
            $data['os_version'] = $data['os_version'] ?? $parsedData['os_version'] ?? null;
            $data['browser'] = $data['browser'] ?? $parsedData['browser'] ?? null;
            $data['browser_version'] = $data['browser_version'] ?? $parsedData['browser_version'] ?? null;
        }

        // Set default expiry
        if (empty($data['expires_at'])) {
            $data['expires_at'] = in_array($data['platform'] ?? 'web', ['ios', 'android']) 
                ? now()->addDays(30)
                : now()->addDays(7);
        }

        return UserLoginHistory::create(array_merge([
            'user_id' => $user->id,
            'token' => $data['token'] ?? $this->generateToken(),
            'login_at' => now(),
            'last_activity_at' => now(),
            'ip_address' => $this->request->ip(),
        ], $data));
    }

    public function updateLastActivity(string $token): bool
    {
        return UserLoginHistory::where('token', $token)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->update(['last_activity_at' => now()]);
    }

    public function logoutSession(string $token, string $reason = null): bool
    {
        $session = UserLoginHistory::where('token', $token)->first();

        if ($session) {
            $session->markAsInactive($reason);
            return true;
        }

        return false;
    }

    public function logoutAllSessions(int $userId, string $reason = null): bool
    {
        return UserLoginHistory::where('user_id', $userId)
            ->where('is_active', true)
            ->update([
                'is_active' => false,
                'logout_reason' => $reason,
                'logout_at' => now()
            ]) > 0;
    }

    public function getActiveSessions(int $userId): Collection
    {
        return UserLoginHistory::where('user_id', $userId)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->orderBy('last_activity_at', 'desc')
            ->get();
    }

    public function getSessionsByPlatform(int $userId, string $platform): Collection
    {
        return UserLoginHistory::where('user_id', $userId)
            ->where('platform', $platform)
            ->orderBy('login_at', 'desc')
            ->get();
    }

    public function getRecentSessions(int $userId, int $days = 30): Collection
    {
        return UserLoginHistory::where('user_id', $userId)
            ->where('login_at', '>=', now()->subDays($days))
            ->orderBy('login_at', 'desc')
            ->get();
    }

    public function paginateUserSessions(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return UserLoginHistory::where('user_id', $userId)
            ->orderBy('login_at', 'desc')
            ->paginate($perPage);
    }

    public function cleanupExpiredSessions(): int
    {
        return UserLoginHistory::where('expires_at', '<', now())
            ->orWhere(function ($query) {
                $query->where('is_active', true)
                    ->where('last_activity_at', '<', now()->subDays(30));
            })
            ->update([
                'is_active' => false,
                'logout_reason' => 'timeout',
                'logout_at' => now()
            ]);
    }

    public function getSessionByToken(string $token): ?UserLoginHistory
    {
        return UserLoginHistory::where('token', $token)->first();
    }

    public function isTokenActive(string $token): bool
    {
        return UserLoginHistory::where('token', $token)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->exists();
    }

    private function generateToken(): string
    {
        return hash('sha256', Str::random(40));
    }

    private function detectPlatform(): string
    {
        $userAgent = strtolower($this->request->userAgent() ?? '');

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

    private function parseUserAgent(): array
    {
        $userAgent = $this->request->userAgent() ?? '';
        
        $deviceType = $this->detectDeviceType($userAgent);
        $osInfo = $this->detectOperatingSystem($userAgent);
        $browserInfo = $this->detectBrowser($userAgent);
        
        return [
            'raw' => $userAgent,
            'device_type' => $deviceType,
            'os_name' => $osInfo['name'],
            'os_version' => $osInfo['version'],
            'browser' => $browserInfo['name'],
            'browser_version' => $browserInfo['version'],
            'is_mobile' => $this->isMobile($userAgent),
            'is_desktop' => $this->isDesktop($userAgent),
            'is_tablet' => $this->isTablet($userAgent),
        ];
    }

    private function detectDeviceType(string $userAgent): string
    {
        if ($this->isMobile($userAgent)) {
            return 'smartphone';
        }
        
        if ($this->isTablet($userAgent)) {
            return 'tablet';
        }
        
        return 'desktop';
    }

    private function detectOperatingSystem(string $userAgent): array
    {
        $userAgent = strtolower($userAgent);
        
        // Windows
        if (str_contains($userAgent, 'windows nt 10')) {
            return ['name' => 'Windows', 'version' => '10'];
        }
        if (str_contains($userAgent, 'windows nt 6.3')) {
            return ['name' => 'Windows', 'version' => '8.1'];
        }
        if (str_contains($userAgent, 'windows nt 6.2')) {
            return ['name' => 'Windows', 'version' => '8'];
        }
        if (str_contains($userAgent, 'windows nt 6.1')) {
            return ['name' => 'Windows', 'version' => '7'];
        }
        if (str_contains($userAgent, 'windows nt 6.0')) {
            return ['name' => 'Windows', 'version' => 'Vista'];
        }
        if (str_contains($userAgent, 'windows nt 5.1')) {
            return ['name' => 'Windows', 'version' => 'XP'];
        }
        if (str_contains($userAgent, 'windows')) {
            return ['name' => 'Windows', 'version' => 'Unknown'];
        }
        
        // macOS
        if (preg_match('/mac os x 10[._](\d+)/', $userAgent, $matches)) {
            $version = '10.' . $matches[1];
            return ['name' => 'macOS', 'version' => $version];
        }
        if (str_contains($userAgent, 'mac os x')) {
            return ['name' => 'macOS', 'version' => 'Unknown'];
        }
        if (str_contains($userAgent, 'macintosh')) {
            return ['name' => 'macOS', 'version' => 'Unknown'];
        }
        
        // Linux
        if (str_contains($userAgent, 'linux')) {
            return ['name' => 'Linux', 'version' => 'Unknown'];
        }
        
        // iOS
        if (preg_match('/os (\d+[._]\d+)/', $userAgent, $matches)) {
            return ['name' => 'iOS', 'version' => str_replace('_', '.', $matches[1])];
        }
        
        // Android
        if (preg_match('/android (\d+[._]\d+)/', $userAgent, $matches)) {
            return ['name' => 'Android', 'version' => str_replace('_', '.', $matches[1])];
        }
        
        return ['name' => 'Unknown', 'version' => null];
    }

    private function detectBrowser(string $userAgent): array
    {
        $userAgent = strtolower($userAgent);
        
        // Chrome
        if (str_contains($userAgent, 'chrome') && !str_contains($userAgent, 'edg')) {
            if (preg_match('/chrome\/(\d+[\.\d]+)/', $userAgent, $matches)) {
                return ['name' => 'Chrome', 'version' => $matches[1]];
            }
            return ['name' => 'Chrome', 'version' => 'Unknown'];
        }
        
        // Firefox
        if (str_contains($userAgent, 'firefox')) {
            if (preg_match('/firefox\/(\d+[\.\d]+)/', $userAgent, $matches)) {
                return ['name' => 'Firefox', 'version' => $matches[1]];
            }
            return ['name' => 'Firefox', 'version' => 'Unknown'];
        }
        
        // Safari
        if (str_contains($userAgent, 'safari') && !str_contains($userAgent, 'chrome')) {
            if (preg_match('/version\/(\d+[\.\d]+)/', $userAgent, $matches)) {
                return ['name' => 'Safari', 'version' => $matches[1]];
            }
            return ['name' => 'Safari', 'version' => 'Unknown'];
        }
        
        // Edge
        if (str_contains($userAgent, 'edg')) {
            if (preg_match('/edg\/(\d+[\.\d]+)/', $userAgent, $matches)) {
                return ['name' => 'Edge', 'version' => $matches[1]];
            }
            return ['name' => 'Edge', 'version' => 'Unknown'];
        }
        
        // Opera
        if (str_contains($userAgent, 'opera')) {
            if (preg_match('/opera\/(\d+[\.\d]+)/', $userAgent, $matches)) {
                return ['name' => 'Opera', 'version' => $matches[1]];
            }
            return ['name' => 'Opera', 'version' => 'Unknown'];
        }
        
        return ['name' => 'Unknown', 'version' => null];
    }

    private function isMobile(string $userAgent): bool
    {
        return preg_match('/(android|webos|iphone|ipod|blackberry|windows phone)/i', $userAgent);
    }

    private function isTablet(string $userAgent): bool
    {
        return preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobile))/i', $userAgent);
    }

    private function isDesktop(string $userAgent): bool
    {
        return !$this->isMobile($userAgent) && !$this->isTablet($userAgent);
    }
}