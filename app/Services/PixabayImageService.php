<?php
namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PixabayImageService
{
    protected static function getApiKey(): ?string
    {
        $dbKey = Setting::getValue('pixabay_api_key');
        if ($dbKey) return $dbKey;
        return env('PIXABAY_API_KEY');
    }

    public static function search(string $query, int $count = 20): array
    {
        $apiKey = self::getApiKey();
        if (!$apiKey) {
            Log::error('PixabayImageService: No API key configured');
            return [];
        }

        try {
            $response = Http::get('https://pixabay.com/api/', [
                'key' => $apiKey,
                'q' => $query,
                'per_page' => min($count, 200),
                'image_type' => 'photo',
                'orientation' => 'horizontal',
                'safesearch' => 'true',
            ]);

            if (!$response->successful()) {
                Log::warning('Pixabay API error: ' . $response->body());
                return [];
            }

            return collect($response->json('hits', []))->map(function ($item) {
                return [
                    'id' => 'pixabay-' . ($item['id'] ?? ''),
                    'url' => $item['webformatURL'] ?? null,
                    'thumb' => $item['previewURL'] ?? null,
                    'download_url' => $item['largeImageURL'] ?? $item['webformatURL'] ?? null,
                    'source' => 'pixabay',
                    'credit' => $item['user'] ?? 'Unknown',
                    'credit_link' => $item['pageURL'] ?? null,
                    'width' => $item['imageWidth'] ?? null,
                    'height' => $item['imageHeight'] ?? null,
                    'alt_description' => $item['tags'] ?? '',
                ];
            })->filter(fn($i) => !empty($i['url']))->values()->toArray();
        } catch (\Exception $e) {
            Log::error('PixabayImageService search error: ' . $e->getMessage());
            return [];
        }
    }
}
