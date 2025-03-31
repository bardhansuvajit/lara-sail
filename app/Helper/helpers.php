<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use App\Repositories\DeveloperSettingRepository;
use App\Repositories\ApplicationSettingRepository;

// frontend design classes array
define("COUNTRY", "IN");
define("FD", [
    'rounded'           => '',                  // rounded-sm/ rounded/ rounded-lg
    'text-0'            => 'text-[10px]',
    'text'              => 'text-xs',
    'text-1'            => 'text-sm',
    'text-2'            => 'text-lg',
    'iconClass'         => 'w-4 h-4',
    'dropdownCaret'     => '<svg class="w-3 h-3 ms-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path></svg>',
    'activeClass'       => 'text-green-500 dark:text-green-600',
    'activeBgClass'     => 'bg-green-500 dark:bg-green-600 text-gray-900 dark:text-gray-100',
]);

define("PRICE_REGEX", "/^\d+(\.\d{1,2})?$/"); // regex for up to 2 decimal places
define("PRODUCT_TYPE", [
    ['key' => 'physical-product', 'title' => 'Physical Product'],
    ['key' => 'service', 'title' => 'Service']
]);

if (!function_exists('fileStore')) {
    /**
     * @param UploadedFile $file
     * @return string The public-accessible file path
     */
    function fileStore(UploadedFile $file): string
    {
        try {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/csv/' . $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($file->getRealPath()));

            return 'storage/' . $filePath;
        } catch(Exception $e) {
            throw new Exception('File could not be stored: ' . $e->getMessage());
        }
    }
}

if (!function_exists('readCsvFile')) {
    /**
     * Read the CSV file and convert it into an array.
     *
     * @param string $filePath
     * @return array
     */
    function readCsvFile(string $filePath): array
    {
        $rows = [];
        try {
            if (($handle = fopen($filePath, 'r')) !== false) {
                $headers = fgetcsv($handle, 1000, ','); // Read the first row as headers
                if ($headers === false) {
                    throw new Exception('CSV file headers are missing or malformed.');
                }

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $rows[] = array_combine($headers, $data); // Combine headers with data
                }
                fclose($handle);
            } else {
                throw new Exception('CSV file could not be opened.');
            }
        } catch (Exception $e) {
            throw new Exception('Error reading CSV file: ' . $e->getMessage());
        }

        return $rows;
    }
}


if (!function_exists('saveToDatabase')) {
    /**
     * Save the data to table.
     *
     * @param array $data
     * @return int Number of records processed
     */
    function saveToDatabase(array $data, string $model): int
    {
        $processedCount = 0;

        try {
            $modelClass = '\\App\\Models\\' . $model;

            if (!class_exists($modelClass)) {
                throw new Exception("Model {$modelClass} does not exist.");
            }

            foreach ($data as $item) {
                if (!isset($item['title'])) {
                    continue; // Skip rows without a title
                }

                $modelClass::create([
                    'title' => $item['title'] ?? null,
                    'slug' => isset($item['title']) ? Str::slug($item['title']) : null,
                    'level' => $item['level'] ?? null,
                    'short_description' => $item['description'] ?? null,
                    'tags' => $item['tags'] ?? null
                ]);

                $processedCount++;
            }
        } catch (Exception $e) {
            throw new Exception('Error saving data to database: ' . $e->getMessage());
        }

        return $processedCount;
    }
}

if (!function_exists('developerSettings')) {
    function developerSettings(String $key) {
        $developerSettingRepository = app(DeveloperSettingRepository::class);
        $resp = $developerSettingRepository->getByKey($key);
        if ($resp['code'] == 200) {
            return json_decode($resp['data']->value);
        } else {
            return false;
        }
    }
}

if (!function_exists('applicationSettings')) {
    function applicationSettings(String $key) {
        $applicationSettingRepository = app(ApplicationSettingRepository::class);
        $resp = $applicationSettingRepository->getByKey($key);
        return json_decode($resp['data']->value);
    }
}

if (!function_exists('fileUpload')) {
    function fileUpload($file, $uploadPath) {
        $tmpPath = $file->getRealPath();
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = uniqid().'-'.time().'.'.$fileExtension;

        $originalFilePath = 'uploads/' . $uploadPath . '/' . $fileName;
        Storage::disk('public')->put($originalFilePath, file_get_contents($tmpPath));

        if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'webp'])) {
            $smallThumbName = 'uploads/'.$uploadPath.'/' .uniqid().'-'.time().'-s.'.$fileExtension;
            $mediumThumbName = 'uploads/'.$uploadPath.'/' .uniqid().'-'.time().'-m.'.$fileExtension;
            $largeThumbName = 'uploads/'.$uploadPath.'/' .uniqid().'-'.time().'-l.'.$fileExtension;

            resizeImage($tmpPath, 100, $smallThumbName);
            resizeImage($tmpPath, 250, $mediumThumbName);
            resizeImage($tmpPath, 500, $largeThumbName);

            return [
                'smallThumbName' => $smallThumbName,
                'mediumThumbName' => $mediumThumbName,
                'largeThumbName' => $largeThumbName
            ];
        } else {
            return [
                'originalFilePath' => $originalFilePath
            ];
        }
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($tmpPath, $height, $fileName) {
        $image = ImageManager::imagick()->read($tmpPath);
        $image->scale(height: $height);

        // Convert the image into binary content
        $thumbnailContent = $image->encode();
        Storage::disk('public')->put($fileName, $thumbnailContent);
    }
}

if (!function_exists('discountPercentageCalc')) {
    function discountPercentageCalc($sellingPrice, $mrp) {
        if (!is_numeric($mrp) || !is_numeric($sellingPrice) || $mrp <= 0) {
            return 0;
        }

        if ($sellingPrice < $mrp) {
            $discount = (($mrp - $sellingPrice) / $mrp) * 100;
            return round($discount);
        } else {
            return 0;
        }
    }
}

if (!function_exists('profitCalc')) {
    function profitCalc($sellingPrice, $cost) {
        if (!is_numeric($cost) || !is_numeric($sellingPrice) || $cost <= 0) {
            return 0;
        }

        if ($cost < $sellingPrice) {
            $profit = $sellingPrice - $cost;
            return round($profit, 2);
        } else {
            return 0;
        }
    }
}

if (!function_exists('marginCalc')) {
    function marginCalc($sellingPrice, $cost) {
        if (!is_numeric($cost) || !is_numeric($sellingPrice) || $cost <= 0) {
            return 0;
        }

        if ($cost < $sellingPrice) {
            $margin = (profitCalc($sellingPrice, $cost) / $sellingPrice) * 100;
            return round($margin, 2);
        } else {
            return 0;
        }
    }
}

if (!function_exists('collectionTitles')) {
    function collectionTitles($collection_ids) {
        $collectionIds = json_decode($collection_ids); 

        $collection_titles = \App\Models\ProductCollection::whereIn('id', $collectionIds)
            ->pluck('title')
            ->implode(',');

        return $collection_titles;
    }
}
