<?php

namespace App\Helpers;

class ImageHelper
{
    public static function uploadAndResize($file, $directory, $width = null, $height = null)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
        $destinationPath = public_path($directory); // Gunakan direktori yang diterima sebagai parameter
        $image = ImageCreateFromJpeg($file->getRealPath());
        // Resize gambar jika lebar diset
        if ($width) {
            $oldWidth = imagesx($image);
            $oldHeight = imagesy($image);
            $aspectRatio = $oldWidth / $oldHeight;
            if (!$height) {
                $height = $width / $aspectRatio; // Hitung tinggi dengan mempertahankan aspek rasio
            }
            $newImage = imagecreatetruecolor($width, $height);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
            imagedestroy($image);
            $image = $newImage;
        }
        // Simpan gambar dengan kualitas asli
        imagejpeg($image, $destinationPath . $fileName);
        imagedestroy($image);

        return $fileName;
    }
}
