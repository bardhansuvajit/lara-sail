<?php

namespace App\Repositories;

use App\Interfaces\PasswordInterface;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordRepository implements PasswordInterface
{
    public function update(array $array)
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
            } elseif ($array['guard'] == 'Api') {
                if (Hash::check($array['current_password'], User::find($array['user_id'])->password)) {
                    $data = User::find($array['user_id']);
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
