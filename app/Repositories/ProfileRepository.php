<?php

namespace App\Repositories;

use App\Interfaces\ProfileInterface;
use App\Models\Admin;
use Intervention\Image\ImageManager;

class ProfileRepository implements ProfileInterface
{
    public function getById(String $guard, Int $id)
    {
        try {
            if ($guard == 'Admin') {
                $data = Admin::find($id);
            }

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
            // dd($array);

            $data = $this->getById($array['guard'], $array['user_id']);

            if ($data['code'] == 200) {
                $data['data']->first_name = $array['first_name'];
                $data['data']->last_name = $array['last_name'];
                $data['data']->email = $array['email'];
                if (!empty($array['phone_country_code'])) {
                    $data['data']->phone_country_code = $array['phone_country_code'];
                }
                $data['data']->phone_no = $array['phone_no'];
                $data['data']->username = $array['username'];

                if (!empty($array['profile_picture'])) {
                    $file = $array['profile_picture'];
                    $tmpPath = $file->getRealPath();
                    $uploadPath = public_path('uploads/profile');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = 'original-'.time() . '.' . $fileExtension;
                    $smallImagePath = $uploadPath.'/'.$fileName.'_small-thumb_'.'.'.$fileExtension;



                    $image = ImageManager::imagick()->read($tmpPath);
                    $image->scale(height: 200);
                    $image->save($smallImagePath);
                }

                $data['data']->save();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Changes have been saved',
                    'data' => $data['data'],
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                // 'message' => 'An error occurred while updating data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function createThumbnail($tmpPath, $filePath, $width, $height)
    {
        // $img = Image::make($tmpPath);
        // $img->resize($width, $height, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($filePath);

        $image = ImageManager::imagick()->read($filePath);
        $image->resize(height: $height)->save($filePath);
    }

}
