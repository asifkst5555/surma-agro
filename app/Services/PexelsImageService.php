<?php
namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PexelsImageService
{
    protected static function getApiKey(): ?string
    {
        $dbKey = Setting::getValue('pexels_api_key');
        if ($dbKey) return $dbKey;
        return env('PEXELS_API_KEY');
    }

    public static function search(string $query, int $count = 20): array
    {
        $apiKey = self::getApiKey();
        if (!$apiKey) {
            Log::error('PexelsImageService: No API key configured');
            return [];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->get('https://api.pexels.com/v1/search', [
                'query' => $query,
                'per_page' => min($count, 80),
                'orientation' => 'landscape',
            ]);

            if (!$response->successful()) {
                Log::warning('Pexels API error: ' . $response->body());
                return [];
            }

            return collect($response->json('photos', []))->map(function ($item) {
                return [
                    'id' => 'pexels-' . ($item['id'] ?? ''),
                    'url' => $item['src']['large'] ?? $item['src']['original'] ?? null,
                    'thumb' => $item['src']['medium'] ?? $item['src']['small'] ?? null,
                    'download_url' => $item['src']['original'] ?? $item['src']['large'] ?? null,
                    'source' => 'pexels',
                    'credit' => $item['photographer'] ?? 'Unknown',
                    'credit_link' => $item['photographer_url'] ?? null,
                    'width' => $item['width'] ?? null,
                    'height' => $item['height'] ?? null,
                    'alt_description' => $item['alt'] ?? '',
                ];
            })->filter(fn($i) => !empty($i['url']))->values()->toArray();
        } catch (\Exception $e) {
            Log::error('PexelsImageService search error: ' . $e->getMessage());
            return [];
        }
    }
}
