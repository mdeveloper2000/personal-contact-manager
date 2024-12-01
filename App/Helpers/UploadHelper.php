<?php

namespace App\Helpers;

class UploadHelper
{

    public static function hasFile($file): bool
    {
        if(isset($file) && !empty($file)) {            
            return true;
        }
        return false;
    }

    public static function sizeLimits(array $file): bool
    {
        if($file["size"] > 0 && $file["size"] < MAX_FILESIZE) {
            return true;
        }
        return false;
    }

    public static function checkExtension(string $mime): bool
    {
        if(in_array($mime, FILE_EXTENSIONS)) {
            return true;
        }
        return false;
    }

    public static function generateFilename(string $mime): string
    {
        $extension = str_replace("image/", "", $mime);
        $filename = md5(rand(1, 1000000) . time()) . ".{$extension}";
        return $filename;
    }

    public static function deleteFile(string $fullpath): void
    {
        if(file_exists($fullpath)) {
            unlink($fullpath);
        }
    }

}