<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait UploadFile
{
    /**
     * public içindeki bir dosyayı alır, işleyip storage/public içine kaydeder.
     *
     * @param  \Illuminate\Http\UploadedFile|string  $file
     */
    public function uploadFilePublicPath($file, ?string $destinationPath = null, ?int $width = 1600): string
    {
        $destinationPath ??= 'uploads';

        if (is_string($file)) {
            $file = ltrim($file, '/');
            $filePath = public_path($file);

            if (! file_exists($filePath)) {
                throw new \Exception("Dosya bulunamadı: {$filePath}");
            }

            $originalExtension = strtolower(File::extension($file));
            $isImage = in_array($originalExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
            $filename = uniqid();

            if ($isImage) {
                $imageManager = new ImageManager(new Driver);
                $image = $imageManager->read($filePath);

                if ($image->width() > $width) {
                    $image->scaleDown(width: $width);
                }

                $filename .= '.webp';
                $newPath = storage_path("app/public/{$destinationPath}/{$filename}");
                File::ensureDirectoryExists(dirname($newPath));

                $image->save($newPath, quality: 80, format: 'webp');
            } else {
                $filename .= '.'.$originalExtension;
                $newPath = storage_path("app/public/{$destinationPath}/{$filename}");
                File::ensureDirectoryExists(dirname($newPath));

                File::copy($filePath, $newPath);
            }

            return "{$destinationPath}/{$filename}";
        }

        $originalExtension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid().'.'.$originalExtension;
        $stored = $file->storeAs("public/{$destinationPath}", $filename);

        if (! $stored) {
            throw new \Exception('Dosya yüklenemedi.');
        }

        return str_replace('public/', 'storage/', $stored);
    }
}
