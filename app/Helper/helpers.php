<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use App\Repositories\DeveloperSettingRepository;
use App\Repositories\ApplicationSettingRepository;

// Country & Pricing
define("FAILSAFE", [
    'country' => 'IN',
    'country_full_name' => 'India',

    'currency_code' => 'INR',
    'currency_icon' => '₹',

    'phone_code' => '+91',
    'phone_no_digits' => '10',
    'postal_code_digits' => '6',

    'flag_svg' => '<svg viewBox="0 0 640 480"xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><path d="M0 0h640v160H0z"fill=#f93 /><path d="M0 160h640v160H0z"fill=#fff /><path d="M0 320h640v160H0z"fill=#128807 /><g transform="matrix(3.2 0 0 3.2 320 240)"><circle r=20 fill=#008 /><circle r=17.5 fill=#fff /><circle r=3.5 fill=#008 /><g id=in-d><g id=in-c><g id=in-b><g id=in-a fill=#008><circle r=.9 transform="rotate(7.5 -8.8 133.5)"/><path d="M0 17.5.6 7 0 2l-.6 5z"/></g><use height=100% transform=rotate(15) width=100% xlink:href=#in-a /></g><use height=100% transform=rotate(30) width=100% xlink:href=#in-b /></g><use height=100% transform=rotate(60) width=100% xlink:href=#in-c /></g><use height=100% transform=rotate(120) width=100% xlink:href=#in-d /><use height=100% transform=rotate(-120) width=100% xlink:href=#in-d /></g></svg>',
]);

// Frontend design classes array
define("FD", [
    'rounded'           => '',
    'text-0'            => 'text-[10px]',
    'text'              => 'text-[10px] md:text-xs',
    'text-1'            => 'text-xs md:text-sm',
    // 'text-1'            => 'text-sm',
    'text-2'            => 'text-base md:text-lg',
    'iconClass'         => 'w-4 h-4',

    'activeClass'       => 'text-green-500 dark:text-green-600',
    'activeBgClass'     => 'bg-green-500 dark:bg-green-600 text-gray-900 dark:text-gray-100',

    'dropdownCaret'     => '<svg class="w-3 h-3 ms-1 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path></svg>',

    'brokenImage'       => '<svg class="max-w-full max-h-full w-32 h-32 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M366.15-412.31h347.7L603.54-558.46l-98.16 123.08-63.53-75.39-75.7 98.46ZM324.62-280q-27.62 0-46.12-18.5Q260-317 260-344.62v-430.76q0-27.62 18.5-46.12Q297-840 324.62-840h430.76q27.62 0 46.12 18.5Q820-803 820-775.38v430.76q0 27.62-18.5 46.12Q783-280 755.38-280H324.62Zm0-40h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H324.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69Zm-120 160q-27.62 0-46.12-18.5Q140-197 140-224.61v-470.77h40v470.77q0 9.23 7.69 16.92 7.69 7.69 16.93 7.69h470.76v40H204.62ZM300-800v480-480Z"/></svg>',

    'brokenImageFront'  => '<svg class="max-w-full max-h-full w-32 h-32 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M366.15-412.31h347.7L603.54-558.46l-98.16 123.08-63.53-75.39-75.7 98.46ZM324.62-280q-27.62 0-46.12-18.5Q260-317 260-344.62v-430.76q0-27.62 18.5-46.12Q297-840 324.62-840h430.76q27.62 0 46.12 18.5Q820-803 820-775.38v430.76q0 27.62-18.5 46.12Q783-280 755.38-280H324.62Zm0-40h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H324.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69Zm-120 160q-27.62 0-46.12-18.5Q140-197 140-224.61v-470.77h40v470.77q0 9.23 7.69 16.92 7.69 7.69 16.93 7.69h470.76v40H204.62ZM300-800v480-480Z"/></svg>',

    'randomTagColors'   => [
        'text-yellow-800 bg-yellow-300 dark:text-yellow-100/60 dark:bg-amber-700/60',
        'text-indigo-800 bg-indigo-300 dark:text-indigo-100/60 dark:bg-sky-700/60',
        'text-purple-800 bg-purple-300 dark:text-purple-100/60 dark:bg-purple-700/60',
        'text-orange-800 bg-orange-300 dark:text-orange-100/60 dark:bg-orange-700/60',
        'text-zinc-800 bg-zinc-300 dark:text-zinc-100/60 dark:bg-zinc-700/60',
    ]
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

/**
 * COUNTRY & CURRENCY DATA
 */
if (!function_exists('countryCurrencyData')) {
    function countryCurrencyData() {
        if (isset($_COOKIE['currency'])) {
            $currencyData = json_decode(urldecode($_COOKIE['currency']), true);
        } else {
            $currencyData = [
                "country" => FAILSAFE['country'],
                "countryFullName" => FAILSAFE['country_full_name'],
                "currency" => FAILSAFE['currency_code'],
                "icon" => FAILSAFE['currency_icon'],
                "phoneCode" => FAILSAFE['phone_code'],
                "phoneNoDigits" => FAILSAFE['phone_no_digits'],
                "postalCodeDigits" => FAILSAFE['postal_code_digits'],
                "flagSvg" => FAILSAFE['flag_svg'],
            ];
        }

        return $currencyData;
    }
}

define("COUNTRY", countryCurrencyData());
/**
 * COUNTRY & CURRENCY DATA
 */

if (!function_exists('applicationSettings')) {
    function applicationSettings(String $key) {
        $applicationSettingRepository = app(ApplicationSettingRepository::class);
        $resp = $applicationSettingRepository->getByKey($key);
        return $resp['data']->value ?? '';
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
        $ratingSvg = '<div class="'.FD['iconClass'].'">
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
            <span class="font-medium text-sm">'.number_format($rating, 1).'</span>
            '.$ratingSvg.'
        </div>
        ';
    }
}

if (!function_exists('formatIndianMoney')) {
    function formatIndianMoney($amount, $decimalPlaces = 2) {
        // detect country from a global $COUNTRY array if available
        global $COUNTRY;
        $countryCode = null;
        if (isset($COUNTRY) && is_array($COUNTRY) && isset($COUNTRY['country'])) {
            $countryCode = $COUNTRY['country'];
        } elseif (defined('COUNTRY') && is_array(COUNTRY) && isset(COUNTRY['country'])) {
            // in case COUNTRY is defined as a constant array (less common)
            $countryCode = COUNTRY['country'];
        }

        // force two decimals only for US
        $forceTwoDecimals = ($countryCode === 'US');

        // If intl is available, use NumberFormatter
        if (extension_loaded('intl')) {
            if ($forceTwoDecimals) {
                // US: always show exactly 2 fraction digits
                $formatter = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
                $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
                // Ensure grouping separators appear as per locale
                return $formatter->format((float)$amount);
            } else {
                // Non-US: keep previous behavior (Indian formatting + trim trailing zeros)
                $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
                $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $decimalPlaces);
                $formatted = $formatter->format((float)$amount);

                // Remove trailing ".00" or any ".X0"/".0X" if decimal part is zero
                if (strpos($formatted, '.') !== false) {
                    $formatted = rtrim(rtrim($formatted, '0'), '.');
                }

                return $formatted;
            }
        }

        // Fallback when intl extension is not available
        if ($forceTwoDecimals) {
            // US fallback: use standard US grouping with exactly two decimals
            return number_format((float)$amount, 2, '.', ',');
        }

        // Non-US fallback: Indian grouping logic (keeps original decimal trimming behavior)
        $amount = round((float) $amount, $decimalPlaces);
        $parts = explode('.', number_format($amount, $decimalPlaces, '.', ''));

        $whole = $parts[0];
        $lastThree = substr($whole, -3);
        $otherNumbers = substr($whole, 0, -3);

        $formatted = ($otherNumbers ? preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $otherNumbers) . ',' : '') . $lastThree;

        // Only add decimal if it's not zero
        if ($decimalPlaces > 0 && !empty($parts[1]) && (int)$parts[1] !== 0) {
            $formatted .= '.' . rtrim($parts[1], '0');
        }

        return $formatted;
    }
}

if (!function_exists('floatConvert')) {
    function floatConvert($val) {
        if ($val === null || $val === '') return 0.0; // or return null if you prefer
        // normalize comma decimal to dot, trim spaces
        $s = trim((string) $val);
        $s = str_replace(',', '.', $s);
        // sanitize and cast
        $num = filter_var($s, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return (float) $num;
    }
}

/*
if (!function_exists('formatIndianMoney')) {
    function formatIndianMoney($amount, $decimalPlaces = 2) {
        // Set Indian locale (requires intl extension)
        if (extension_loaded('intl')) {
            $formatter = new NumberFormatter('en_IN', NumberFormatter::DECIMAL);
            $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $decimalPlaces);
            $formatted = $formatter->format($amount);

            // Remove trailing ".00" or any ".X0"/".0X" if decimal part is zero
            if (strpos($formatted, '.') !== false) {
                $formatted = rtrim(rtrim($formatted, '0'), '.');
            }

            return $formatted;
        }

        // Fallback for when intl extension is not available
        $amount = round((float) $amount, $decimalPlaces);
        $parts = explode('.', number_format($amount, $decimalPlaces, '.', ''));

        $whole = $parts[0];
        $lastThree = substr($whole, -3);
        $otherNumbers = substr($whole, 0, -3);

        $formatted = ($otherNumbers ? preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $otherNumbers) . ',' : '') . $lastThree;

        // Only add decimal if it's not zero
        if ($decimalPlaces > 0 && !empty($parts[1]) && (int)$parts[1] !== 0) {
            $formatted .= '.' . rtrim($parts[1], '0');
        }

        return $formatted;
    }
}
*/

/*
if (! function_exists('ratingBadgeClasses')) {
    function ratingBadgeClasses(?float $rating): string
    {
        if (empty($rating) || $rating <= 0) {
            return 'hidden';
        }

        $base = 'pointer-events-auto inline-flex items-center gap-1 text-xs font-semibold px-2 py-0.5 shadow-sm';
        if ($rating >= 4.5)
            return "$base bg-green-600 dark:bg-green-700 text-white";
        if ($rating >= 3.5)
            return "$base bg-green-500 dark:bg-green-600 text-white";
        if ($rating >= 2.5)
            return "$base bg-amber-400 dark:bg-amber-500 text-black";
        if ($rating >= 1.5)
            return "$base bg-orange-500 dark:bg-orange-600 text-white".FD['rounded'];

        return "$base bg-red-600 dark:bg-red-700 text-white";
    }
}
*/