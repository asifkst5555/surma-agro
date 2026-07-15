<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Format;

class ImageDownloadService
{
    public static function download($url, $productName = null, $subfolder = 'products')
    {
        $response = Http::timeout(30)->get($url);
        if (!$response->successful()) {
            throw new \Exception("Failed to download image from {$url}");
        }

        $imageContent = $response->body();
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $imageContent);
        finfo_close($finfo);

        $extension = self::mimeToExtension($mimeType);
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            throw new \Exception("Unsupported image type: {$mimeType}");
        }

        $filename = self::generateFilename($productName, $extension);

        $subPath = $subfolder ? "ai-images/{$subfolder}/{$filename}" : "ai-images/{$filename}";
        Storage::disk('public')->put($subPath, $imageContent);

        $fullPath = Storage::disk('public')->path($subPath);
        $imageSize = getimagesize($fullPath);

        return [
            'path' => $subPath,
            'filename' => $filename,
            'mime_type' => $mimeType,
            'width' => $imageSize[0] ?? null,
            'height' => $imageSize[1] ?? null,
            'file_size' => strlen($imageContent),
            'full_path' => $fullPath,
        ];
    }

    public static function downloadWithThumbnail($url, $productName = null, $subfolder = 'products')
    {
        $result = self::download($url, $productName, $subfolder);

        $thumbFilename = 'thumb_' . $result['filename'];
        $thumbPath = "ai-images/thumbnails/{$thumbFilename}";

        try {
            $img = Image::decode($result['full_path']);
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $thumbEncoded = $img->encodeUsingFormat(Format::WEBP, quality: 70);
            Storage::disk('public')->put($thumbPath, (string) $thumbEncoded);
            $result['thumbnail_path'] = $thumbPath;
        } catch (\Exception $e) {
            $result['thumbnail_path'] = $result['path'];
        }

        return $result;
    }

    private static function generateFilename($productName, $extension)
    {
        $slug = $productName ? Str::slug($productName) : 'image';
        $unique = Str::random(8);
        return "{$slug}-{$unique}.{$extension}";
    }

    private static function mimeToExtension($mime)
    {
        $map = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
        ];
        return $map[$mime] ?? 'jpg';
    }
}
