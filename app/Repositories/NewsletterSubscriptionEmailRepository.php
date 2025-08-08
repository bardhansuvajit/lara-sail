<?php

namespace App\Repositories;

use App\Interfaces\NewsletterSubscriptionEmailInterface;
use App\Models\NewsletterSubscriptionEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

use App\Exports\BannersExport;
use Maatwebsite\Excel\Facades\Excel;

class NewsletterSubscriptionEmailRepository implements NewsletterSubscriptionEmailInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = NewsletterSubscriptionEmail::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%')
                        ->orWhere('web_redirect_url', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_redirect_type', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_redirect_target', 'like', '%' . $keyword . '%');
                });
            }

            // filters
            foreach ($filters as $field => $value) {
                if (!is_null($value) && $value !== '') {
                    if (is_array($value)) {
                        $query->whereIn($field, $value);
                    } else {
                        $query->where($field, '=', $value);
                    }
                }
            }

            // page
            $data = $perPage !== 'all'
            ? $query->orderBy($sortBy, $sortOrder)->paginate($perPage)->withQueryString()
            : $query->orderBy($sortBy, $sortOrder)->get();

            if ($data->isNotEmpty()) {
                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data found',
                    'data' => $data,
                ];
            }
    
            return [
                'code' => 404,
                'status' => 'failure',
                'message' => 'No data found',
                'data' => [],
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

    public function subscribe(Array $array)
    {
        // dd($array['image']);
        try {
            $data = new NewsletterSubscriptionEmail();
            $data->email = $array['email'];
            $data->ip_address = $array['ip_address'];
            $data->user_agent = $array['user_agent'];
            $data->web_redirect_url = $array['web_redirect_url'];
            $data->mobile_redirect_target = $array['mobile_redirect_target'];
            $data->mobile_redirect_type = $array['mobile_redirect_type'];

            // get max position for given attribute_id and type
            $lastPosition = NewsletterSubscriptionEmail::max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;

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
