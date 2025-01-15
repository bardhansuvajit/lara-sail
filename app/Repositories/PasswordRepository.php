<?php

namespace App\Repositories;

use App\Interfaces\PasswordInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class PasswordRepository implements PasswordInterface
{
    public function update(Array $array)
    {
        // dd($array);
        try {
            if ($array['guard'] == 'Admin') {
                if (Hash::check($array['current_password'], Admin::find($array['user_id'])->password)) {
                    $data = Admin::find($array['user_id']);
                    $data->password = Hash::make($array['new_password']);
                    $data->save();

                    return [
                        'code' => 200,
                        'status' => 'success',
                        'message' => 'Password has been changed',
                        'data' => $data,
                    ];
                } else {
                    return [
                        'code' => 401,
                        'status' => 'error',
                        'message' => 'Current password is incorrect',
                    ];
                }
            } else {
                return [
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'Unauthorized access',
                ];
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
