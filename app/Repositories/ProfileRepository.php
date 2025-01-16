<?php

namespace App\Repositories;

use App\Interfaces\ProfileInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
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
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = uniqid().'-'.time().'.'.$fileExtension;

                    // Paths
                    $storagePath = 'uploads/profile';
                    $originalFilePath = $storagePath . '/' . $fileName;

                    // Store the original file
                    Storage::disk('public')->put($originalFilePath, file_get_contents($tmpPath));

                    // Resize the image and store the thumbnail
                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'webp'])) {
                        $thumbnailFileName = 'original-' . time() . '_small-thumb.' . $fileExtension;
                        $thumbnailFilePath = $storagePath . '/' . $thumbnailFileName;

                        $image = ImageManager::imagick()->read($tmpPath);
                        $image->scale(height: 200);
                        $thumbnailContent = $image->encode(); // Convert the image into binary content
                        Storage::disk('public')->put($thumbnailFilePath, $thumbnailContent);
                    }

                    // return [
                    //     'original' => Storage::disk('public')->url($originalFilePath),
                    //     'thumbnail' => Storage::disk('public')->url($thumbnailFilePath),
                    // ];
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
    }

}
