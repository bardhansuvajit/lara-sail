<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                    'short_description' => $item['description'] ?? null,
                ]);

                $processedCount++;
            }
        } catch (Exception $e) {
            throw new Exception('Error saving data to database: ' . $e->getMessage());
        }

        return $processedCount;
    }
}

if (!function_exists('fetchDeveloperSettings')) {
    function fetchDeveloperSettings() {
        $resp = $this->settingRepository->getByType('developer');
    }
}