<?php

use App\Models\Addon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('num')) {
    function num($number)
    {
        $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];
        foreach ($abbrevs as $exponent => $abbrev) {
            if (abs($number) >= pow(10, $exponent)) {
                $display = $number / pow(10, $exponent);
                $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
                $number = number_format($display, $decimals) . $abbrev;
                break;
            }
        }
        return $number;
    }
}

if (!function_exists('getCountryByIp')) {
    /**
     * Get country name by IP address using a public API
     *
     * @param string $ip
     * @return string|null
     */
    function getCountryByIp($ip)
    {
        try {
            // Replace with a valid IP address API
            $response = file_get_contents("https://ipapi.co/{$ip}/country_name/");
            
            if ($response) {
                return trim($response); // Return the country name
            }
            return null; // If no response
        } catch (\Exception $e) {
            return null; // Handle exceptions gracefully
        }
    }
}


if (!function_exists('timeago')) {
    function timeago($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('SetEnv')) {
    function SetEnv($key, $value, $quote = false)
    {
        $path = base_path('.env');

        if (!file_exists($path)) {
            throw new \Exception('.env file does not exist.');
        }

        $envContents = file_get_contents($path);

        // Escape special characters in the value
        $escapedValue = str_replace(['$', '"'], ['\$', '\"'], $value);

        // Add quotes if the $quote parameter is true
        if ($quote) {
            $escapedValue = "\"{$escapedValue}\"";
        }

        $pattern = "/^{$key}=.*/m";

        if (preg_match($pattern, $envContents)) {
            // Update the existing value
            $envContents = preg_replace($pattern, "{$key}={$escapedValue}", $envContents);
        } else {
            // Append the new key-value pair
            $envContents .= "\n{$key}={$escapedValue}";
        }

        // Write the updated contents back to the .env file
        file_put_contents($path, $envContents);

        // Clear the configuration cache
        Artisan::call('config:clear');
    }
}

if (!function_exists('geo')) {
    function geo($ip)
    {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        return $ipdat;
    }
}

function storageFileUpload($file, $location, $disk, $specificName = null, $old = null)
{
    if (!empty($old)) {
        removeFileFromStorage($old, $disk);
    }
    $filename = generateUniqueFileName($file, $specificName);
    $filePath = $location . $filename;
    Storage::disk($disk)->put($filePath, fopen($file, 'r+'));
    return $filePath;
}

function generateUniqueFileName($file, $specificName = null)
{
    if (!empty($specificName)) {
        $filename = $specificName . '.' . $file->getClientOriginalExtension();
    } else {
        $filename = Str::random(15) . '_' . time() . '.' . $file->getClientOriginalExtension();
    }
    return $filename;
}

function removeFile($path)
{
    if (File::exists($path)) {
        File::delete($path);
    }
    return true;
}

function removeDirectory($path)
{
    if (File::exists($path)) {
        File::deleteDirectory($path);
    }
    return true;
}

function makeDirectory($path)
{
    if (!File::exists($path)) {
        File::makeDirectory($path, 0775, true);
    }
    return true;
}

function isAddonActive($alias)
{
    $addon = Addon::where('alias', $alias)->first();
    if ($addon) {
        if ($addon->hasNoStatus() || $addon->isActive()) {
            return true;
        }
    }
    return false;
}
