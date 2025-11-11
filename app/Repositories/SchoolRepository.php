<?php

namespace App\Repositories;

use App\Interfaces\SchoolInterface;
use App\Models\School;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;

use App\Exports\SchoolsExport;
use Maatwebsite\Excel\Facades\Excel;

class SchoolRepository implements SchoolInterface
{
    private TrashInterface $trashRepository;

    public function __construct(TrashInterface $trashRepository)
    {
        $this->trashRepository = $trashRepository;
    }

    public function list(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = School::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('code', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%')
                        ->orWhere('district', 'like', '%' . $keyword . '%')
                        ->orWhere('address', 'like', '%' . $keyword . '%')
                        ->orWhere('type', 'like', '%' . $keyword . '%')
                        ->orWhere('level', 'like', '%' . $keyword . '%')
                        ->orWhere('meta_title', 'like', '%' . $keyword . '%')
                        ->orWhere('meta_description', 'like', '%' . $keyword . '%')
                        ->orWhere('tags', 'like', '%' . $keyword . '%');
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

    public function store(array $array)
    {
        try {
            DB::beginTransaction();

            $data = new School();

            // Basic Information
            $data->name = $array['name'];
            $data->slug = $array['slug']; // Use the slug from form input
            $data->code = !empty($array['code']) ? strtoupper($array['code']) : null;
            $data->description = $array['description'] ?? null;

            // Location Information
            $data->country_code = $array['country_code'] ?? 'IN';
            $data->state = $array['state'];
            $data->district = $array['district'];
            $data->city = $array['city'];
            $data->address = $array['address'];
            $data->pincode = $array['pincode'] ?? null;

            // School Details
            $data->type = $array['type'];
            $data->level = $array['level'];
            $data->board_affiliation = $array['board_affiliation'];

            // Academic Information
            $data->established_year = !empty($array['established_year']) ? (int)$array['established_year'] : null;
            $data->principal_name = $array['principal_name'] ?? null;
            $data->student_count = !empty($array['student_count']) ? (int)$array['student_count'] : null;
            $data->teacher_count = !empty($array['teacher_count']) ? (int)$array['teacher_count'] : null;

            // Contact Information
            $data->official_email = $array['official_email'] ?? null;
            $data->phone_number = $array['phone_number'] ?? null;
            $data->alternate_phone = $array['alternate_phone'] ?? null;
            $data->website = $array['website'] ?? null;
            $data->fax = $array['fax'] ?? null;

            // Contact Person Details
            $data->contact_person_name = $array['contact_person_name'] ?? null;
            $data->contact_person_designation = $array['contact_person_designation'] ?? null;
            $data->contact_person_mobile = $array['contact_person_mobile'] ?? null;
            $data->contact_person_email = $array['contact_person_email'] ?? null;

            // SEO Information
            $data->meta_title = $array['meta_title'] ?? null;
            $data->meta_description = $array['meta_description'] ?? null;

            // Tags
            if (!empty($array['tags'])) {
                $tagsArray = array_map('trim', explode(',', $array['tags']));
                $data->tags = json_encode($tagsArray);
            }

            // Image Upload
            if (!empty($array['image'])) {
                $uploadResp = fileUpload($array['image'], 'sch');
                $data->logo_path = $uploadResp['largeThumbName'] ?? null;
            }

            // Position and Status
            $lastPosition = School::max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;
            $data->status = $array['status'] ?? 1; // Use status from form

            $data->save();

            DB::commit();

            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Changes have been saved',
                'data' => $data,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while creating the school.',
                'error' => $e->getMessage(),
            ];
        }
    }

    /*
    public function store(array $array)
    {
        // dd($array['image']);
        try {
            $data = new School();
            $data->name = $array['name'];
            $data->slug = Str::slug($array['name']);

            $data->code = strtoupper($array['code']) ?? null;
            $data->description = $array['description'] ?? null;

            if (!empty($array['image'])) {
                $uploadResp = fileUpload($array['image'], 'sch');

                // $data->image_s = $uploadResp['smallThumbName'];
                // $data->image_m = $uploadResp['mediumThumbName'];
                $data->logo_path = $uploadResp['largeThumbName'];
            } else {
                $data->thumbnail_icon = $this->getSchoolSvg();
            }

            // get max position for given attribute_id and type
            $lastPosition = School::max('position');
            $data->position = $lastPosition ? $lastPosition + 1 : 1;

            $data->status = 0;
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
    */

    public function getById(int $id)
    {
        try {
            $data = School::find($id);

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

    public function getBySlug(String $slug)
    {
        try {
            $data = School::where('slug', $slug)->first();

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
                $data['data']->title = $array['title'];
                $data['data']->slug = \Str::slug($array['title']);

                $data['data']->short_description = $array['short_description'] ?? null;
                $data['data']->long_description = $array['long_description'] ?? null;

                if (!empty($array['image'])) {
                    $uploadResp = fileUpload($array['image'], 'sch');

                    $data['data']->image_s = $uploadResp['smallThumbName'];
                    $data['data']->image_m = $uploadResp['mediumThumbName'];
                    $data['data']->image_l = $uploadResp['largeThumbName'];
                }

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

    public function delete(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'School',
                    'table_name' => 'schools',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => $data['data']->image_s,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from schools table',
                    'status' => 'deleted',
                ]);

                $data['data']->delete();

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => $data,
                ];
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while deleting data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function bulkAction(array $array)
    {
        try {
            $data = School::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {

                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'School',
                        'table_name' => 'schools',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from schools table',
                        'status' => 'deleted',
                    ]);

                    $item->delete();
                });

                return [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data deleted',
                    'data' => [],
                ];
            } else {
                return [
                    'code' => 400,
                    'status' => 'failure',
                    'message' => 'Invalid action',
                    'data' => [],
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

    public function import(UploadedFile $file)
    {
        try {
            $filePath = fileStore($file);
            $data = readCsvFile(public_path($filePath));
            // $processedCount = saveToDatabase($data, 'School');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                // get max position for given attribute_id and type
                $lastPosition = School::max('position');

                School::create([
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => !empty($item['title']) ? Str::slug($item['title']) : null,
                    'short_description' => !empty($item['short_description']) ? $item['short_description'] : null,
                    'long_description' => !empty($item['long_description']) ? $item['long_description'] : null,
                    'tags' => !empty($item['tags']) ? $item['tags'] : null,
                    'meta_title' => !empty($item['meta_title']) ? $item['meta_title'] : null,
                    'meta_desc' => !empty($item['meta_desc']) ? $item['meta_desc'] : null,
                    'position' => !empty($item['position']) ? $item['position'] : 1,
                    'status' => 0,
                    'position' => $lastPosition ? $lastPosition + 1 : 1
                ]);

                $processedCount++;
            }

            return [
                'code' => 200,
                'status' => 'success',
                'message' => $processedCount.' Data uploaded',
                'data' => [],
            ];
        } catch (\Exception $e) {
            \Log::error('CSV Import Error: ' . $e->getMessage());

            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while uploading data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?String $keyword = '', array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "schools_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new SchoolsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new SchoolsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new SchoolsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new SchoolsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
                }
                else {
                    return [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Invalid export type.',
                    ];
                }
            } else {
                return [
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'No data available for export.',
                ];
            }
        } catch (\Exception $e) {
            \Log::error('Export Repository Error: ' . $e->getMessage(), [
                'filters' => $filters,
                'exception' => $e
            ]);
    
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An unexpected error occurred while preparing the export.',
            ];
        }
    }

    public function position(array $ids)
    {
        try {
            foreach ($ids as $index => $id) {
                School::where('id', $id)->update([
                    'position' => $index + 1
                ]);
            }
            School::clearActiveCollectionsCache();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Position updated'
            ]);
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while positioning data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    private function getSchoolSvg()
    {
        return '<?xml version="1.0" encoding="iso-8859-1"?>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve">
            <polygon style="fill:#D35B38;" points="10.01,202.261 501.991,202.261 440.932,113.913 71.069,113.913 "/>
            <polygon style="fill:#F2F2F2;" points="189.189,202.261 25.773,202.261 25.773,414.102 483.719,414.102 483.719,202.261 320.303,202.261 254.746,97.898 "/>
            <circle style="fill:#73C1DD;" cx="254.742" cy="219.016" r="29.029"/>
            <rect x="210.699" y="300.947" style="fill:#FFAD61;" width="88.087" height="113.112"/>
            <rect x="328.815" y="276.073" style="fill:#73C1DD;" width="47.337" height="43.897"/>
            <rect x="328.815" y="319.966" style="fill:#FFE6B8;" width="47.337" height="27.177"/>
            <rect x="406.602" y="276.073" style="fill:#73C1DD;" width="47.337" height="43.897"/>
            <rect x="406.602" y="319.966" style="fill:#FFE6B8;" width="47.337" height="27.177"/>
            <rect x="55.545" y="276.073" style="fill:#73C1DD;" width="47.337" height="43.897"/>
            <rect x="55.545" y="319.966" style="fill:#FFE6B8;" width="47.337" height="27.177"/>
            <rect x="133.332" y="276.073" style="fill:#73C1DD;" width="47.337" height="43.897"/>
            <rect x="133.332" y="319.966" style="fill:#FFE6B8;" width="47.337" height="27.177"/>
            <g>
                <path style="fill:#4D3D36;" d="M510.226,196.57l-61.059-88.347c-1.869-2.705-4.947-4.318-8.235-4.318H270.34l-7.117-11.33
                    c-1.832-2.916-5.033-4.686-8.476-4.686c-3.443,0-6.645,1.77-8.476,4.686l-7.117,11.33H71.069c-3.287,0-6.365,1.615-8.235,4.318
                    L1.775,196.57c-2.116,3.062-2.358,7.045-0.63,10.34c1.729,3.296,5.143,5.36,8.865,5.36h5.753v201.831
                    c0,5.528,4.481,10.01,10.01,10.01h457.947c5.528,0,10.01-4.481,10.01-10.01V212.271h8.261c3.722,0,7.136-2.065,8.865-5.36
                    C512.584,203.614,512.342,199.631,510.226,196.57z M435.682,123.923l47.223,68.328H325.836l-42.92-68.328H435.682z M76.319,123.923
                    h150.258l-42.92,68.328H29.096L76.319,123.923z M220.713,404.054v-93.092h68.067v93.092H220.713z M189.19,212.271
                    c3.443,0,6.645-1.77,8.476-4.686l57.08-90.87l57.08,90.87c1.832,2.916,5.033,4.686,8.476,4.686h153.407v191.822H308.8v-103.14
                    c0-5.528-4.481-10.01-10.01-10.01h-88.087c-5.528,0-10.01,4.481-10.01,10.01v103.14H35.783V212.271H189.19z"/>
                <path style="fill:#4D3D36;" d="M254.746,179.979c-21.526,0-39.039,17.512-39.039,39.039s17.512,39.039,39.039,39.039
                    c21.526,0,39.039-17.512,39.039-39.039S276.272,179.979,254.746,179.979z M254.746,238.036c-10.487,0-19.019-8.531-19.019-19.019
                    c0-10.487,8.531-19.019,19.019-19.019s19.019,8.531,19.019,19.019C273.765,229.505,265.234,238.036,254.746,238.036z"/>
                <path style="fill:#4D3D36;" d="M240.232,321.347c-5.528,0-10.01,4.481-10.01,10.01v10.636c0,5.528,4.481,10.01,10.01,10.01
                    s10.01-4.481,10.01-10.01v-10.636C250.242,325.829,245.76,321.347,240.232,321.347z"/>
                <path style="fill:#4D3D36;" d="M269.26,321.347c-5.528,0-10.01,4.481-10.01,10.01v10.636c0,5.528,4.481,10.01,10.01,10.01
                    s10.01-4.481,10.01-10.01v-10.636C279.27,325.829,274.789,321.347,269.26,321.347z"/>
                <path style="fill:#4D3D36;" d="M386.168,276.074c0-5.528-4.481-10.01-10.01-10.01h-47.339c-5.528,0-10.01,4.481-10.01,10.01v71.07
                    c0,5.528,4.481,10.01,10.01,10.01h47.339c5.528,0,10.01-4.481,10.01-10.01V276.074z M366.148,337.134h-27.319v-7.153h27.319
                    V337.134z M338.829,286.084h27.319v23.878h-27.319V286.084z"/>
                <path style="fill:#4D3D36;" d="M463.953,276.074c0-5.528-4.481-10.01-10.01-10.01h-47.339c-5.528,0-10.01,4.481-10.01,10.01v71.07
                    c0,5.528,4.481,10.01,10.01,10.01h47.339c5.528,0,10.01-4.481,10.01-10.01V276.074z M443.933,337.134h-27.319v-7.153h27.319
                    V337.134z M416.614,286.084h27.319v23.878h-27.319V286.084z"/>
                <path style="fill:#4D3D36;" d="M112.898,276.074c0-5.528-4.481-10.01-10.01-10.01H55.549c-5.528,0-10.01,4.481-10.01,10.01v71.07
                    c0,5.528,4.481,10.01,10.01,10.01h47.339c5.528,0,10.01-4.481,10.01-10.01C112.898,347.144,112.898,276.074,112.898,276.074z
                    M65.559,286.084h27.319v23.878H65.559V286.084z M92.878,337.134H65.559v-7.153h27.319V337.134z"/>
                <path style="fill:#4D3D36;" d="M190.683,276.074c0-5.528-4.481-10.01-10.01-10.01h-47.339c-5.528,0-10.01,4.481-10.01,10.01v71.07
                    c0,5.528,4.481,10.01,10.01,10.01h47.339c5.528,0,10.01-4.481,10.01-10.01L190.683,276.074L190.683,276.074z M143.344,286.084
                    h27.319v23.878h-27.319V286.084z M170.663,337.134h-27.319v-7.153h27.319L170.663,337.134L170.663,337.134z"/>
                <path style="fill:#4D3D36;" d="M340.831,182.982h55.054c5.528,0,10.01-4.481,10.01-10.01s-4.481-10.01-10.01-10.01h-55.054
                    c-5.528,0-10.01,4.481-10.01,10.01S335.303,182.982,340.831,182.982z"/>
                <path style="fill:#4D3D36;" d="M426.916,182.982h4.004c5.528,0,10.01-4.481,10.01-10.01s-4.481-10.01-10.01-10.01h-4.004
                    c-5.528,0-10.01,4.481-10.01,10.01S421.388,182.982,426.916,182.982z"/>
            </g>
        </svg>';
    }
}
