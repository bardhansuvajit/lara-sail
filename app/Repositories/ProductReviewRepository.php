<?php

namespace App\Repositories;

use App\Interfaces\ProductReviewInterface;
use App\Models\ProductReview;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use App\Interfaces\ProductReviewImageInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use App\Exports\ProductReviewsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductReviewRepository implements ProductReviewInterface
{
    private TrashInterface $trashRepository;
    private ProductReviewImageInterface $productReviewImageRepository;

    public function __construct(TrashInterface $trashRepository, ProductReviewImageInterface $productReviewImageRepository)
    {
        $this->trashRepository = $trashRepository;
        $this->productReviewImageRepository = $productReviewImageRepository;
    }

    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = ProductReview::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('short_description', 'like', '%' . $keyword . '%')
                        ->orWhere('long_description', 'like', '%' . $keyword . '%')
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

    public function store(Array $array)
    {
        // dd($array['image']);

        try {
            // Check if Review already exist for this product_id & user_id
            $reviewExistCheck = $this->conditions([
                'product_id' => $array['product_id'],
                'user_id' => $array['user_id'],
            ]);

            if ($reviewExistCheck['code'] == 200) {
                return [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'This user has already rated this item.',
                ];
            }

            // dd($reviewExistCheck);

            $data = new ProductReview();
            $data->product_id = $array['product_id'];
            $data->user_id = $array['user_id'];
            $data->rating = $array['rating'];
            $data->title = $array['title'] ? $array['title'] : null;
            $data->review = $array['review'];
            $data->save();

            // IMAGES
            if (isset($array['images']) && count($array['images']) > 0) {
                foreach($array['images'] as $imageKey => $singleImage) {
                    $uploadResp = fileUpload($singleImage, 'p-review-img');

                    $imageData = [
                        'review_id' => $data->id,
                        'image_s' => $uploadResp['smallThumbName'],
                        'image_m' => $uploadResp['mediumThumbName'],
                        'image_l' => $uploadResp['largeThumbName'],
                    ];
                    $imageResp = $this->productReviewImageRepository->store($imageData);
                }
            }

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

    public function getById(Int $id)
    {
        try {
            $data = ProductReview::find($id);

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

    public function conditions(Array $array)
    {
        try {
            $data = ProductReview::where($array)->get();

            if (count($data) > 0) {
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
        // dd($array);
        try {
            $data = $this->getById($array['id']);

            if ($data['code'] == 200) {
                // $data['data']->title = $array['title'];
                // $data['data']->slug = \Str::slug($array['title']);
                // $data['data']->level = $array['level'];
                // $data['data']->parent_id = $array['parent_id'] ?? null;

                // if (!empty($array['image'])) {
                //     $uploadResp = fileUpload($array['image'], 'p-cat');

                //     $data['data']->image_s = $uploadResp['smallThumbName'];
                //     $data['data']->image_m = $uploadResp['mediumThumbName'];
                //     $data['data']->image_l = $uploadResp['largeThumbName'];
                // }

                // $data['data']->save();

                $data['data']->product_id = $array['product_id'];
                $data['data']->user_id = $array['user_id'];
                $data['data']->rating = $array['rating'];
                $data['data']->title = $array['title'] ? $array['title'] : null;
                $data['data']->review = $array['review'];
                $data['data']->save();

                // IMAGES
                if (isset($array['images']) && count($array['images']) > 0) {
                    foreach($array['images'] as $imageKey => $singleImage) {
                        $uploadResp = fileUpload($singleImage, 'p-review-img');

                        $imageData = [
                            'review_id' => $array['id'],
                            'image_s' => $uploadResp['smallThumbName'],
                            'image_m' => $uploadResp['mediumThumbName'],
                            'image_l' => $uploadResp['largeThumbName'],
                        ];
                        $imageResp = $this->productReviewImageRepository->store($imageData);
                    }
                }

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
                // 'message' => 'An error occurred while updating data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function delete(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'ProductReview',
                    'table_name' => 'product_reviews',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => null,
                    'title' => $data['data']->title,
                    'description' => $data['data']->title.' data deleted from product reviews table',
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

    public function bulkAction(Array $array)
    {
        try {
            $data = ProductReview::whereIn('id', $array['ids'])->get();
            if ($array['action'] == 'delete') {
                $data->each(function ($item) {
                    // Handling trash
                    $this->trashRepository->store([
                        'model' => 'ProductReview',
                        'table_name' => 'product_reviews',
                        'deleted_row_id' => $item->id,
                        'thumbnail' => $item->image_s,
                        'title' => $item->title,
                        'description' => $item->title.' data deleted from product reviews table',
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
            'failed'    => 0,
            'errors'    => [],
        ];

        $toIntOrNull = fn($v) => ($v === '' || $v === null) ? null : (int)$v;
        $toStrOrNull = fn($v) => ($v === '' || $v === null) ? null : trim($v);

        try {
            $filePath = fileStore($file);
            $rows = readCsvFile(public_path($filePath)); // returns array of assoc rows

            foreach ($rows as $i => $row) {
                $summary['processed']++;

                // sanitize inputs
                $productId = $toIntOrNull(Arr::get($row, 'product_id'));
                $userId    = $toIntOrNull(Arr::get($row, 'user_id'));
                $rating    = $toIntOrNull(Arr::get($row, 'rating')) ?: 1;
                $title     = $toStrOrNull(Arr::get($row, 'title'));
                $review    = $toStrOrNull(Arr::get($row, 'review'));
                $status    = $toIntOrNull(Arr::get($row, 'status')) ?? 0;

                // validation
                if (!$productId) {
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => 'missing product_id'];
                    continue;
                }
                if (!$review) {
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => 'missing review'];
                    continue;
                }

                try {
                    DB::beginTransaction();

                    // Optionally, check if product exists
                    $productExists = \App\Models\Product::where('id', $productId)->exists();
                    if (!$productExists) {
                        throw new \Exception("Invalid product_id: {$productId}");
                    }

                    $reviewData = [
                        'product_id' => $productId,
                        'user_id'    => $userId,
                        'rating'     => $rating,
                        'title'      => $title,
                        'review'     => $review,
                        'status'     => $status,
                    ];

                    // create new review (no dedupe unless you want to check user+product unique)
                    \App\Models\ProductReview::create($reviewData);

                    DB::commit();
                    $summary['created']++;
                } catch (\Throwable $e) {
                    DB::rollBack();
                    $summary['failed']++;
                    $summary['errors'][] = ['row' => $i + 1, 'reason' => $e->getMessage()];
                    Log::error("CSV import row ".($i+1)." failed: ".$e->getMessage());
                    continue;
                }
            }

            return [
                'code'    => 200,
                'status'  => 'success',
                'message' => "{$summary['created']} / {$summary['processed']} rows processed. {$summary['failed']} failed.",
                'data'    => $summary,
            ];
        } catch (\Throwable $e) {
            Log::error('CSV Import Error (Reviews): ' . $e->getMessage());
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
            // $processedCount = saveToDatabase($data, 'ProductReview');

            // save into Database
            $processedCount = 0;

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                ProductReview::create([
                    'title' => $item['title'] ? $item['title'] : null,
                    'slug' => isset($item['title']) ? Str::slug($item['title']) : null,
                    'parent_id' => $item['parent_id'] ? $item['parent_id'] : null,
                    'level' => $item['level'] ? $item['level'] : null,
                    'short_description' => $item['short_description'] ? $item['short_description'] : null,
                    'long_description' => $item['long_description'] ? $item['long_description'] : null,
                    'tags' => $item['tags'] ? $item['tags'] : null,
                    'meta_title' => $item['meta_title'] ? $item['meta_title'] : null,
                    'meta_desc' => $item['meta_desc'] ? $item['meta_desc'] : null,
                    'status' => $item['status'] ? $item['status'] : 0
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
                // 'message' => 'An error occurred while uploading data.',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }
    */

    public function export(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "product_reviews_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductReviewsExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductReviewsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductReviewsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductReviewsExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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

    public function activeFDReviewsByProductId(Int $productId, Int $count)
    {
        try {
            $data = ProductReview::with(['user', 'images'])
                ->where('product_id', $productId)
                ->where('status', 1)
                ->limit($count)
                ->get();

            if (count($data) > 0) {
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

    public function allActivePaginatedReviewsByProductId(Int $productId)
    {
        try {
            $data = ProductReview::with(['user', 'images'])
                ->where('product_id', $productId)
                ->where('status', 1)
                ->paginate(15)
                ->withQueryString();

            if (count($data) > 0) {
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
}
