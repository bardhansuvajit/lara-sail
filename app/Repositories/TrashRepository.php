<?php

namespace App\Repositories;

use App\Interfaces\TrashInterface;
use App\Models\Trash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

use App\Exports\ProductCategoriesExport;
use Maatwebsite\Excel\Facades\Excel;

class TrashRepository implements TrashInterface
{
    public function list(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc') : array
    {
        try {
            DB::enableQueryLog();
            $query = Trash::query();

            // keyword
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('model', 'like', '%' . $keyword . '%')
                        ->orWhere('table_name', 'like', '%' . $keyword . '%')
                        ->orWhere('title', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
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
        try {
            $data = new Trash();
            $data->model = $array['model'];
            $data->table_name = $array['table_name'];
            $data->deleted_row_id = $array['deleted_row_id'];
            $data->title = $array['title'];
            $data->description = $array['description'];
            $data->status = $array['status'] ?? 'deleted';
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
                'message' => 'An error occurred while storing data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getById(Int $id)
    {
        try {
            $data = Trash::find($id);

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

    public function restore(Int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // $data['data']->delete();

                $dataTable = $data['data']->table_name;
                $dataModel = $data['data']->model;
                $dataModelClass = "App\\Models\\$dataModel";
                $dataId = $data['data']->id;
                // restoring
                // $dataModelClass::withTrashed()
                // ->where('id', $dataId)
                // ->restore();

                // return [
                //     'code' => 200,
                //     'status' => 'success',
                //     'message' => 'Data restored',
                //     'data' => $data,
                // ];

                $restored = $dataModelClass::withTrashed()
                    ->where('id', $dataId)
                    ->restore();

                if ($restored) {
                    return [
                        'code' => 200,
                        'status' => 'success',
                        'message' => 'Data restored successfully.',
                        'data' => $data,
                    ];
                } else {
                    return [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Failed to restore the record. It may not exist or is already active.',
                    ];
                }
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'An error occurred while restoring data.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function export(?String $keyword = '', Array $filters = [], String $perPage, String $sortBy = 'id', String $sortOrder = 'asc', String $type)
    {
        try {
            $data = $this->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

            if (count($data['data']) > 0) {
                $fileName = "product_categories_export_" . date('Y-m-d') . '-' . time();

                if ($type == 'excel') {
                    $fileExtension = ".xlsx";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension);
                }
                elseif ($type == 'csv') {
                    $fileExtension = ".csv";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::CSV);
                }
                elseif ($type == 'html') {
                    $fileExtension = ".html";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::HTML);
                }
                elseif ($type == 'pdf') {
                    $fileExtension = ".pdf";
                    return Excel::download(new ProductCategoriesExport($data['data']), $fileName.$fileExtension, \Maatwebsite\Excel\Excel::TCPDF);
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
}
