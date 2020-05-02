<?php
namespace App\Utils;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\Utility\Hash;

class ImageUtils {

    public static function uploadTmpFile(array $data, string $dirPath, int $maxLongSideSize): ?string {
        if (!$data || !is_array($data)) {
            return null;
        }

        $tmpPath = Hash::get($data, 'tmp_name');
        $error = Hash::get($data, 'error');

        if (!$tmpPath) {
            return null;
        }

        if ($error != UPLOAD_ERR_OK || !is_uploaded_file($tmpPath)) {
            throw new \Exception('TODO');
        }

        do {
            $distFileName = substr(bin2hex(random_bytes(24)), 0, 24);
            $distFileName .= '.' . pathinfo(Hash::get($data, 'name'), PATHINFO_EXTENSION);

            $distPath = $dirPath . $distFileName;

            if (!file_exists($distPath)) {
                break;
            }
        } while(true);

        if (!move_uploaded_file($tmpPath, $distPath)) {
            throw new \Exception('TODO');
        }

        self::resizeImage($distPath, $maxLongSideSize);

        return $distPath;
    }

    public static function deleteOldTmpFile(string $dirPath, string $expireSec): void {
        $dir = new Folder($dirPath);
        $fileNames = $dir->find();
        
        foreach ($fileNames as $fileName) {
            $filePath = $dir->path . $fileName;

            if (!is_file($filePath)) {
                continue;
            }

            $file = new File($dirPath . $fileName);
            $lastChangeTime = Time::createFromTimestamp($file->lastChange());

            if (!$lastChangeTime->wasWithinLast("{$expireSec} seconds")) {
                $file->delete();
            }
        }
    }

    public static function resizeImage($path, $maxLongSideSize): void {
        list($orgWidth, $orgHeight) = getimagesize($path);

        if ($orgWidth <= $maxLongSideSize && $orgHeight <= $maxLongSideSize) {
            return;
        }

        if ($orgWidth <= $orgHeight) {
            $ratio = $maxLongSideSize / $orgHeight;
            $distHeight = $maxLongSideSize;
            $distWidth = round($orgWidth * $ratio);
        } else {
            $ratio = $maxLongSideSize / $orgWidth;
            $distWidth = $maxLongSideSize;
            $distHeight = round($orgHeight * $ratio);
        }

        switch (pathinfo($path, PATHINFO_EXTENSION)) {
            case 'jpg':
            case 'jpeg':
            case 'JPG':
            case 'JPEG':
                $imageCreateFromMethod = 'imagecreatefromjpeg';
                $imageExportMethod = 'imagejpeg';
                $quality = 90;
                break;
            case 'png':
            case 'PNG':
                $imageCreateFromMethod = 'imagecreatefrompng';
                $imageExportMethod = 'imagepng';
                $quality = 9;
                break;
            case 'gif':
            case 'GIF':
                $imageCreateFromMethod = 'imagecreatefromgif';
                $imageExportMethod = 'imagegif';
                $quality = 90;
                break;
            default:
                throw new \Exception('TODO');
        }

        $orgImg = $imageCreateFromMethod($path);
        $distImg = imagecreatetruecolor($distWidth, $distHeight);
 
        imagecopyresized($distImg, $orgImg, 0, 0, 0, 0, $distWidth, $distHeight, $orgWidth, $orgHeight);

        $imageExportMethod($distImg, $path, $quality);

        imagedestroy($orgImg);
        imagedestroy($distImg);
    }
}