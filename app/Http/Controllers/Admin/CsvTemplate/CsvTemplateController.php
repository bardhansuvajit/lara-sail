<?php

namespace App\Http\Controllers\Admin\CsvTemplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CsvTemplate;
use Illuminate\Support\Facades\Storage;

class CsvTemplateController
{
    public function download($model)
    {
        $csvTemplate = CsvTemplate::where('model', $model)->first();

        if (!$csvTemplate) abort(404);
        $filePath = 'csv_templates/' . $csvTemplate->file_path;
        if (!Storage::disk('public')->exists($filePath)) abort(404);

        return Storage::disk('public')->download($filePath);
    }

}
