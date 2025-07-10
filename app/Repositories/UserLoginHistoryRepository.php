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

    public function store(Array $array)
    {
        // dd($array['image']);
        try {
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
}
