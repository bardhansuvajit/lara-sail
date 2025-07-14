<?php

namespace App\Repositories;

use App\Interfaces\UserLoginHistoryInterface;
use App\Models\UserLoginHistory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\TrashInterface;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserLoginHistoryRepository implements UserLoginHistoryInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function exists(Array $conditions)
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

    public function store(Array $array)
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
            $data->device_brand = $array['device_brand'];
            $data->os_version = $array['os_version'];
            $data->device_model = $array['device_model'];
            $data->app_version = $array['app_version'];
            $data->latitude = $array['latitude'];
            $data->longitude = $array['longitude'];
            $data->ip_address = $array['ip_address'];
            $data->payload = $array['payload'];
            $data->login_at = $array['login_at'];
            $data->last_activity_at = $array['last_activity_at'];
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
                // 'message' => 'An error occurred while storing data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function validateToken(String $token, Int $userId)
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
                    // 'data' => [],
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

    public function getById(Int $id)
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

    public function update(Array $array)
    {
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                // $data['data']->platform = $array['platform'];
                // $data['data']->device_brand = $array['device_brand'];
                // $data['data']->os_version = $array['os_version'];
                // $data['data']->device_model = $array['device_model'];
                // $data['data']->app_version = $array['app_version'];
                // $data['data']->latitude = $array['latitude'];
                // $data['data']->longitude = $array['longitude'];
                // $data['data']->ip_address = $array['ip_address'];
                // $data['data']->payload = $array['payload'];
                // $data['data']->login_at = $array['login_at'];
                // $data['data']->last_activity_at = $array['last_activity_at'];
                $data['data']->is_active = $array['is_active'];
                $data['data']->last_activity_at = $array['last_activity_at'];
                $data['data']->expires_at = $array['expires_at'];
                $data['data']->logout_reason = $array['logout_reason'];
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

}
