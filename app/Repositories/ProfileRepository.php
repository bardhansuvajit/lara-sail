<?php

namespace App\Repositories;

use App\Interfaces\ProfileInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use App\Interfaces\CountryInterface;

class ProfileRepository implements ProfileInterface
{
    private CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

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
                $data['data']->phone_no = $array['phone_no'];
                $data['data']->username = $array['username'];
                if (!empty($array['phone_country_code'])) {
                    $countryData = $this->countryRepository->getByShortName($array['phone_country_code']);
                    if($countryData['code'] == 200) $data['data']->phone_country_code = $countryData['data']->phone_code;
                }

                if (!empty($array['profile_picture'])) {
                    $uploadResp = fileUpload($array['profile_picture'], 'profile');

                    $data['data']->profile_picture_s = $uploadResp['smallThumbName'];
                    $data['data']->profile_picture_m = $uploadResp['mediumThumbName'];
                    $data['data']->profile_picture_l = $uploadResp['largeThumbName'];
                }

                if (!empty($array['alt_phone_country_code'])) {
                    $countryData = $this->countryRepository->getByShortName($array['alt_phone_country_code']);
                    if($countryData['code'] == 200) $data['data']->alt_phone_country_code = $countryData['data']->phone_code;
                }

                $data['data']->alt_phone_no = $array['alt_phone_no'];

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
                'message' => 'An error occurred while updating data.',
                'error' => $e->getMessage(),
            ];
        }
    }

}
