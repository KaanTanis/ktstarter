<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait UploadFile
{
    /**
     * Dosyayı public dizinine yükler ve yeni adıyla kaydeder.
     *
     * @param  \Illuminate\Http\UploadedFile|string  $file  - Yüklenecek dosya
     * @param  string|null  $destinationPath  - Hedef dizin (opsiyonel)
     * @return string - Yeni dosya yolu
     */
    public function uploadFilePublicPath($file, $destinationPath = null)
    {
        // Dosyanın tam yolunu al
        $filePath = public_path($file);

        // Hedef dizin yoksa, public dizinini kullan
        $destinationPath ??= 'storage';

        // Dosya adı ve uzantısını al
        $fileName = uniqid().'.'.File::extension($file);

        // Dosyanın hedef dizin yolunu oluştur
        $newPath = public_path($fileName);

        // Dosya bir resimse, boyutlandır
        if (in_array(File::extension($file), ['jpg', 'jpeg', 'png', 'gif'])) {
            $imageManager = new ImageManager(new Driver);

            $image = $imageManager->read($filePath);

            // Resmi boyutlandır
            $image->scaleDown(width: 1200);

            // Resmi webp formatına dönüştür
            $image->save($filePath, 70, 'webp');

            // Dosya adını güncelle
            $fileName = pathinfo($fileName, PATHINFO_FILENAME).'.webp';
            $newPath = public_path($fileName);
        }

        // Dosyayı kopyala
        if (Storage::disk('public')->put($fileName, File::get($filePath))) {
            return $fileName;
        }

        // Eğer kopyalama başarısız olursa hata döndür
        throw new \Exception('Dosya kopyalanırken bir hata oluştu.');
    }
}
