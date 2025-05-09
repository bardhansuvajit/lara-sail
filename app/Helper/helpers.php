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
    'rounded'           => '',
    'text-0'            => 'text-[10px]',
    'text'              => 'text-xs',
    'text-1'            => 'text-sm',
    'text-2'            => 'text-lg',
    'iconClass'         => 'w-4 h-4',
    'failSafeCurrency'  => 'INR',

    'activeClass'       => 'text-green-500 dark:text-green-600',
    'activeBgClass'     => 'bg-green-500 dark:bg-green-600 text-gray-900 dark:text-gray-100',

    'dropdownCaret'     => '<svg class="w-3 h-3 ms-1 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path></svg>',
    'brokenImage'       => '<svg class="max-w-full max-h-full w-32 h-32 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M366.15-412.31h347.7L603.54-558.46l-98.16 123.08-63.53-75.39-75.7 98.46ZM324.62-280q-27.62 0-46.12-18.5Q260-317 260-344.62v-430.76q0-27.62 18.5-46.12Q297-840 324.62-840h430.76q27.62 0 46.12 18.5Q820-803 820-775.38v430.76q0 27.62-18.5 46.12Q783-280 755.38-280H324.62Zm0-40h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H324.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69Zm-120 160q-27.62 0-46.12-18.5Q140-197 140-224.61v-470.77h40v470.77q0 9.23 7.69 16.92 7.69 7.69 16.93 7.69h470.76v40H204.62ZM300-800v480-480Z"/></svg>',
    'brokenImageFront'  => '<svg class="max-w-full max-h-full w-32 h-32 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M366.15-412.31h347.7L603.54-558.46l-98.16 123.08-63.53-75.39-75.7 98.46ZM324.62-280q-27.62 0-46.12-18.5Q260-317 260-344.62v-430.76q0-27.62 18.5-46.12Q297-840 324.62-840h430.76q27.62 0 46.12 18.5Q820-803 820-775.38v430.76q0 27.62-18.5 46.12Q783-280 755.38-280H324.62Zm0-40h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H324.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69Zm-120 160q-27.62 0-46.12-18.5Q140-197 140-224.61v-470.77h40v470.77q0 9.23 7.69 16.92 7.69 7.69 16.93 7.69h470.76v40H204.62ZM300-800v480-480Z"/></svg>',
]);

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


/*
if (!function_exists('saveToDatabase')) {
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
*/

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

if (!function_exists('countryCurrencyData')) {
    function countryCurrencyData() {
        if (isset($_COOKIE['currency'])) {
            $currencyData = json_decode(urldecode($_COOKIE['currency']), true);
        } else {
            $currencyData = [
                "country" => env('FAILSAFE_COUNTRY'),
                "currency" => env('FAILSAFE_CURRENCY')
            ];
        }

        return $currencyData;
    }
}

if (!function_exists('applicationSettings')) {
    function applicationSettings(String $key) {
        $applicationSettingRepository = app(ApplicationSettingRepository::class);
        $resp = $applicationSettingRepository->getByKey($key);
        return $resp['data']->value;
        // return json_decode($resp['data']->value);
    }
}

if (!function_exists('fileUpload')) {
    function fileUpload($file, $uploadPath) {
        $tmpPath = $file->getRealPath();
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = uniqid().'-'.time().'.'.$fileExtension;

        // file extension check
        if (in_array($fileExtension, developerSettings('image_validation')->image_upload_mimes_array)) {
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
        } else { 
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Invalid File Extension: '.$fileExtension
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

if (!function_exists('genderString')) {
    function genderString($genderId) {
        switch ($genderId) {
            case 1:
                return 'Male';
                break;
            case 2:
                return 'Female';
                break;
            case 3:
                return 'Other';
                break;
            case 4:
                return 'Not specified';
                break;
            default:
                return 'Not specified';
                break;
        }
    }
}

if (!function_exists('adminRatingHtml')) {
    function adminRatingHtml($rating) {
        $ratingSvg = '<div class="w-3 h-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-269 314-169q-11 7-23 6t-21-8q-9-7-14-17.5t-2-23.5l44-189-147-127q-10-9-12.5-20.5T140-571q4-11 12-18t22-9l194-17 75-178q5-12 15.5-18t21.5-6q11 0 21.5 6t15.5 18l75 178 194 17q14 2 22 9t12 18q4 11 1.5 22.5T809-528L662-401l44 189q3 13-2 23.5T690-171q-9 7-21 8t-23-6L480-269Z"/></svg>
        </div>';

        if ($rating <= 1) {
            $colorCode = 'bg-red-600 text-gray-100';
        } elseif ($rating > 1 && $rating <= 2) {
            $colorCode = 'bg-orange-600 text-gray-100';
        } elseif ($rating > 2 && $rating <= 3) {
            $colorCode = 'bg-yellow-700 text-gray-100';
        } elseif ($rating > 3 && $rating <= 4) {
            $colorCode = 'bg-lime-600 text-gray-100';
        } elseif ($rating > 4 && $rating <= 5) {
            $colorCode = 'bg-green-700 text-gray-100';
        } else {
            $colorCode = 'bg-gray-900 text-gray-100';
        }

        return '<div class="inline-flex items-center space-x-1 px-1 '.$colorCode.'">
            <span class="font-medium">'.number_format($rating, 1).'</span>
            '.$ratingSvg.'
        </div>
        ';
    }
}

if (!function_exists('frontRatingHtml')) {
    function frontRatingHtml($rating) {
        $ratingSvg = '<div class="w-3 h-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-269 314-169q-11 7-23 6t-21-8q-9-7-14-17.5t-2-23.5l44-189-147-127q-10-9-12.5-20.5T140-571q4-11 12-18t22-9l194-17 75-178q5-12 15.5-18t21.5-6q11 0 21.5 6t15.5 18l75 178 194 17q14 2 22 9t12 18q4 11 1.5 22.5T809-528L662-401l44 189q3 13-2 23.5T690-171q-9 7-21 8t-23-6L480-269Z"/></svg>
        </div>';

        if ($rating <= 1) {
            $colorCode = 'bg-red-600 text-gray-100';
        } elseif ($rating > 1 && $rating <= 2) {
            $colorCode = 'bg-orange-600 text-gray-100';
        } elseif ($rating > 2 && $rating <= 3) {
            $colorCode = 'bg-yellow-700 text-gray-100';
        } elseif ($rating > 3 && $rating <= 4) {
            $colorCode = 'bg-lime-600 text-gray-100';
        } elseif ($rating > 4 && $rating <= 5) {
            $colorCode = 'bg-green-700 text-gray-100';
        } else {
            $colorCode = 'bg-gray-900 text-gray-100';
        }

        return '<div class="inline-flex items-center space-x-1 px-1 '.$colorCode.'">
            <span class="font-medium text-xs">'.number_format($rating, 1).'</span>
            '.$ratingSvg.'
        </div>
        ';
    }
}

if (!function_exists('formatIndianMoney')) {
    function formatIndianMoney($amount, $decimalPlaces = 2) {
        // Set Indian locale (requires intl extension)
        if (extension_loaded('intl')) {
            $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
            $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $decimalPlaces);
            return $formatter->format($amount);
        }
        
        // Fallback for when intl extension is not available
        $amount = round((float) $amount, $decimalPlaces);
        $parts = explode('.', number_format($amount, $decimalPlaces, '.', ''));
        
        $whole = $parts[0];
        $lastThree = substr($whole, -3);
        $otherNumbers = substr($whole, 0, -3);
        
        $formatted = ($otherNumbers ? preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $otherNumbers) . ',' : '') . $lastThree;
        
        if ($decimalPlaces > 0 && !empty($parts[1])) {
            $formatted .= '.' . $parts[1];
        }
        
        return $formatted;
    }
}