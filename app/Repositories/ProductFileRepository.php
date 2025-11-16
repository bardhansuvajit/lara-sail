<?php

namespace App\Repositories;

use App\Interfaces\ProductFileInterface;
use App\Models\ProductFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TrashInterface;
use Illuminate\Support\Facades\Log;

class ProductFileRepository implements ProductFileInterface
{
    private TrashInterface $trashRepository;

    public function __construct(
        TrashInterface $trashRepository, 
    )
    {
        $this->trashRepository = $trashRepository;
    }

    public function getById(int $id)
    {
        try {
            $data = ProductFile::find($id);

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

    public function delete(int $id)
    {
        try {
            $data = $this->getById($id);

            if ($data['code'] == 200) {
                // Handling trash
                $this->trashRepository->store([
                    'model' => 'ProductFile',
                    'table_name' => 'product_files',
                    'deleted_row_id' => $data['data']->id,
                    'thumbnail' => null,
                    'title' => $data['data']->file_name,
                    'description' => $data['data']->file_name.' data deleted from product files table',
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

}
