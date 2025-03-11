<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use App\Repositories\DeveloperSettingRepository;
use App\Repositories\ApplicationSettingRepository;

define("PRICE_REGEX", "/^\d+(\.\d{1,2})?$/"); // regex for up to 2 decimal places

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
        return json_decode($resp['data']->value);
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
