<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Format;

class ImageOptimizeService
{
    public static function optimize($imagePath, $quality = 80)
    {
        $fullPath = Storage::disk('public')->path($imagePath);
        if (!file_exists($fullPath)) {
            throw new \Exception("File not found: {$fullPath}");
        }

        $info = pathinfo($fullPath);
        $webpPath = "{$info['dirname']}/{$info['filename']}.webp";
        $relativeWebp = str_replace(Storage::disk('public')->path(''), '', $webpPath);

        $img = Image::decode($fullPath);
        $encoded = $img->encodeUsingFormat(Format::WEBP, quality: $quality);
        Storage::disk('public')->put($relativeWebp, (string) $encoded);

        if ($info['extension'] !== 'webp') {
            @unlink($fullPath);
        }

        return $relativeWebp;
    }

    public static function createThumbnail($imagePath, $size = 300)
    {
        $fullPath = Storage::disk('public')->path($imagePath);
        if (!file_exists($fullPath)) {
            throw new \Exception("File not found: {$fullPath}");
        }

        $info = pathinfo($fullPath);
        $thumbPath = "ai-images/thumbnails/{$info['filename']}-thumb.webp";

        $img = Image::decode($fullPath);
        $img->resize($size, $size, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $encoded = $img->encodeUsingFormat(Format::WEBP, quality: 70);
        Storage::disk('public')->put($thumbPath, (string) $encoded);
        return $thumbPath;
    }

    public static function createResponsiveVersions($imagePath)
    {
        $versions = [];
        $sizes = [
            'sm' => 320,
            'md' => 640,
            'lg' => 1024,
        ];

        foreach ($sizes as $label => $width) {
            $fullPath = Storage::disk('public')->path($imagePath);
            $info = pathinfo($fullPath);
            $versionPath = "ai-images/optimized/{$info['filename']}-{$label}.webp";

            $img = Image::decode($fullPath);
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $encoded = $img->encodeUsingFormat(Format::WEBP, quality: 75);
            Storage::disk('public')->put($versionPath, (string) $encoded);
            $versions[$label] = $versionPath;
        }

        return $versions;
    }

    public static function getImageDimensions($imagePath)
    {
        $fullPath = Storage::disk('public')->path($imagePath);
        if (!file_exists($fullPath)) return null;

        $size = getimagesize($fullPath);
        return $size ? ['width' => $size[0], 'height' => $size[1]] : null;
    }
}
