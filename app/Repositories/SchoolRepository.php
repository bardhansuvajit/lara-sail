<?php

namespace App\Repositories;

use App\Interfaces\SchoolInterface;
use App\Models\School;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

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
            $data->slug = Str::slug($array['name']);
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
            $data->status = 0;

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
                // $data['data']->title = $array['title'];
                // $data['data']->slug = \Str::slug($array['title']);

                // $data['data']->short_description = $array['short_description'] ?? null;
                // $data['data']->long_description = $array['long_description'] ?? null;

                // if (!empty($array['image'])) {
                //     $uploadResp = fileUpload($array['image'], 'sch');

                //     $data['data']->image_s = $uploadResp['smallThumbName'];
                //     $data['data']->image_m = $uploadResp['mediumThumbName'];
                //     $data['data']->image_l = $uploadResp['largeThumbName'];
                // }

                // $data['data']->save();

                $data = $data['data'];

                // Basic Information
                $data->name = $array['name'];
                $data->slug = Str::slug($array['name']);
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
                $data->status = 0;

                $data->save();

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
                    'thumbnail' => $data['data']->logo_path,
                    'title' => $data['data']->name,
                    'description' => $data['data']->name.' data deleted from schools table',
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
                        'thumbnail' => $item->logo_path,
                        'title' => $item->name,
                        'description' => $item->name.' data deleted from schools table',
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
        $summary = [
            'processed' => 0,
            'created'   => 0,
            'skipped'   => 0,
            'failed'    => 0,
            'errors'    => [],
            'skipped_rows' => [],
        ];

        $toIntOrNull = fn($v) => ($v === '' || $v === null || $v === '""') ? null : (int)$v;
        $toStringOrNull = fn($v) => ($v === '' || $v === null || $v === '""') ? null : (string)$v;
        $toBool = fn($v) => ($v === '1' || $v === 1 || $v === 'true' || $v === true);

        try {
            $filePath = fileStore($file);
            $rows = readCsvFile(public_path($filePath)); // array of assoc rows

            foreach ($rows as $i => $row) {
                $summary['processed']++;

                $name = trim(Arr::get($row, 'name', ''));
                if ($name === '' || $name === '""') {
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => 'missing school name'];
                    continue;
                }

                try {
                    DB::beginTransaction();

                    // Check if already exists - use provided slug or generate from name
                    $slug = $toStringOrNull(Arr::get($row, 'slug'));
                    if (!$slug) {
                        $slug = Str::slug($name);
                    }
                    
                    $existing = School::where('slug', $slug)->first();

                    if ($existing) {
                        $summary['skipped']++;
                        $summary['skipped_rows'][] = $i + 1;
                        DB::rollBack(); // no changes
                        continue;
                    }

                    // Get next position
                    $lastPosition = School::max('position') ?? 1;

                    // Process tags - handle both JSON string and comma-separated formats
                    $tags = null;
                    $tagsInput = $toStringOrNull(Arr::get($row, 'tags'));
                    if ($tagsInput) {
                        // Check if it's already a JSON string (starts with [ and ends with ])
                        if (str_starts_with($tagsInput, '[') && str_ends_with($tagsInput, ']')) {
                            // It's JSON format, decode it
                            $decodedTags = json_decode($tagsInput, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $tags = json_encode($decodedTags);
                            } else {
                                // If JSON decode fails, treat as comma-separated
                                $tagsArray = array_map('trim', explode(',', str_replace(['"', '[', ']'], '', $tagsInput)));
                                $tags = json_encode($tagsArray);
                            }
                        } else {
                            // Treat as comma-separated values
                            $tagsArray = array_map('trim', explode(',', $tagsInput));
                            $tags = json_encode($tagsArray);
                        }
                    }

                    // Process numeric fields with proper null handling
                    $establishedYear = $toIntOrNull(Arr::get($row, 'established_year'));
                    $studentCount = $toIntOrNull(Arr::get($row, 'student_count'));
                    $teacherCount = $toIntOrNull(Arr::get($row, 'teacher_count'));
                    $questionPapersCount = $toIntOrNull(Arr::get($row, 'question_papers_count'));

                    // Create school record
                    School::create([
                        // Basic Information
                        'name' => $name,
                        'slug' => $slug,
                        'code' => $toStringOrNull(Arr::get($row, 'code')),
                        'country_code' => $toStringOrNull(Arr::get($row, 'country_code', 'IN')),
                        'logo_path' => $toStringOrNull(Arr::get($row, 'logo_path')),
                        'description' => $toStringOrNull(Arr::get($row, 'description')),

                        // Location Information
                        'district' => $toStringOrNull(Arr::get($row, 'district')),
                        'address' => $toStringOrNull(Arr::get($row, 'address')),
                        'city' => $toStringOrNull(Arr::get($row, 'city')),
                        'state' => $toStringOrNull(Arr::get($row, 'state', 'West Bengal')),
                        'pincode' => $toStringOrNull(Arr::get($row, 'pincode')),

                        // School Details
                        'type' => $toStringOrNull(Arr::get($row, 'type', 'government')),
                        'level' => $toStringOrNull(Arr::get($row, 'level', 'secondary')),
                        'board_affiliation' => $toStringOrNull(Arr::get($row, 'board_affiliation')),

                        // Contact Information
                        'official_email' => $toStringOrNull(Arr::get($row, 'official_email')),
                        'phone_number' => $toStringOrNull(Arr::get($row, 'phone_number')),
                        'alternate_phone' => $toStringOrNull(Arr::get($row, 'alternate_phone')),
                        'website' => $toStringOrNull(Arr::get($row, 'website')),
                        'fax' => $toStringOrNull(Arr::get($row, 'fax')),

                        // Contact Person Details
                        'contact_person_name' => $toStringOrNull(Arr::get($row, 'contact_person_name')),
                        'contact_person_designation' => $toStringOrNull(Arr::get($row, 'contact_person_designation')),
                        'contact_person_mobile' => $toStringOrNull(Arr::get($row, 'contact_person_mobile')),
                        'contact_person_email' => $toStringOrNull(Arr::get($row, 'contact_person_email')),

                        // Academic Information
                        'established_year' => $establishedYear,
                        'principal_name' => $toStringOrNull(Arr::get($row, 'principal_name')),

                        // SEO Information
                        'meta_title' => $toStringOrNull(Arr::get($row, 'meta_title')),
                        'meta_description' => $toStringOrNull(Arr::get($row, 'meta_description')),

                        // Tags
                        'tags' => $tags,

                        // Statistics
                        'question_papers_count' => $questionPapersCount ?? 0,
                        'student_count' => $studentCount,
                        'teacher_count' => $teacherCount,

                        // Position and Status (default values)
                        'position' => $toIntOrNull(Arr::get($row, 'position', $lastPosition + 1)),
                        'status' => $toIntOrNull(Arr::get($row, 'status', 1)),
                        'is_featured' => $toBool(Arr::get($row, 'is_featured', false)),

                        // Timestamps
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    DB::commit();
                    $summary['created']++;
                } catch (\Throwable $e) {
                    DB::rollBack();
                    $summary['failed']++;
                    $summary['errors'][] = [
                        'row'    => $i + 1,
                        'reason' => $e->getMessage(),
                    ];
                    Log::error("School import row ".($i+1)." failed: ".$e->getMessage());
                    continue;
                }
            }

            return [
                'code'    => 200,
                'status'  => 'success',
                'message' => "{$summary['created']} / {$summary['processed']} schools processed. {$summary['skipped']} skipped, {$summary['failed']} failed.",
                'data'    => $summary,
            ];
        } catch (\Throwable $e) {
            Log::error('CSV School Import Error: ' . $e->getMessage());
            return [
                'code'    => 500,
                'status'  => 'error',
                'message' => 'Import failed: ' . $e->getMessage(),
                'error'   => $e->getMessage(),
            ];
        }
    }

    /*
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
    */

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

}
