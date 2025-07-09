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
            $data->first_name = $array['first_name'];
            $data->last_name = $array['last_name'];
            $data->email = $array['email'] ?? null;
            $data->country_code = $array['country_code'];
            $data->primary_phone_no = $array['primary_phone_no'];
            $data->gender_id = $array['gender_id'] ?? 4;
            $data->password = $array['password'] ? Hash::make($array['password']) : Hash::make($array['primary_phone_no']);
            $data->alt_phone_no = $array['alt_phone_no'] ?? null;
            $data->date_of_birth = $array['date_of_birth'] ?? null;
            $data->profile_picture = $array['profile_picture'] ?? null;
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
