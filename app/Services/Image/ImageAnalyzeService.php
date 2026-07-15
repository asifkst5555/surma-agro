<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;

class ImageAnalyzeService
{
    const MIN_WIDTH = 400;
    const MIN_HEIGHT = 300;
    const MIN_FILE_SIZE = 10240; // 10KB
    const MAX_FILE_SIZE = 10485760; // 10MB

    public static function analyze($imagePath)
    {
        $fullPath = Storage::disk('public')->path($imagePath);
        if (!file_exists($fullPath)) {
            return ['pass' => false, 'reason' => 'File not found'];
        }

        $imageSize = @getimagesize($fullPath);
        if (!$imageSize) {
            return ['pass' => false, 'reason' => 'Invalid image file'];
        }

        $width = $imageSize[0];
        $height = $imageSize[1];
        $fileSize = filesize($fullPath);

        $issues = [];

        if ($width < self::MIN_WIDTH || $height < self::MIN_HEIGHT) {
            $issues[] = 'Resolution too low';
        }

        if ($fileSize < self::MIN_FILE_SIZE) {
            $issues[] = 'File too small';
        }

        if ($fileSize > self::MAX_FILE_SIZE) {
            $issues[] = 'File too large';
        }

        $blurScore = self::detectBlur($fullPath);
        if ($blurScore < 50) {
            $issues[] = 'Image may be blurry';
        }

        $hasWatermark = self::detectWatermark($fullPath);
        if ($hasWatermark) {
            $issues[] = 'Potential watermark detected';
        }

        return [
            'pass' => empty($issues),
            'issues' => $issues,
            'width' => $width,
            'height' => $height,
            'file_size' => $fileSize,
            'blur_score' => $blurScore,
            'has_watermark' => $hasWatermark,
            'aspect_ratio' => $width / max($height, 1),
        ];
    }

    private static function detectBlur($path)
    {
        try {
            $img = imagecreatefromstring(file_get_contents($path));
            if (!$img) return 0;

            $width = imagesx($img);
            $height = imagesy($img);

            $small = imagecreatetruecolor(64, 64);
            imagecopyresampled($small, $img, 0, 0, 0, 0, 64, 64, $width, $height);

            $laplacian = 0;
            for ($y = 1; $y < 63; $y++) {
                for ($x = 1; $x < 63; $x++) {
                    $c = imagecolorat($small, $x, $y);
                    $gray = ($c >> 16) & 0xFF;
                    $cx = imagecolorat($small, $x + 1, $y);
                    $gx = ($cx >> 16) & 0xFF;
                    $cy = imagecolorat($small, $x, $y + 1);
                    $gy = ($cy >> 16) & 0xFF;
                    $laplacian += abs($gray - $gx) + abs($gray - $gy);
                }
            }

            imagedestroy($img);
            imagedestroy($small);

            $score = min(100, $laplacian / 100);
            return $score;
        } catch (\Exception $e) {
            return 50;
        }
    }

    private static function detectWatermark($path)
    {
        try {
            $content = file_get_contents($path);
            $watermarkKeywords = ['watermark', 'shutterstock', 'istock', 'getty', '123rf', 'dreamstime', 'depositphotos', 'alamy'];
            $lower = strtolower($content);
            foreach ($watermarkKeywords as $keyword) {
                if (str_contains($lower, $keyword)) return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
