<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageSearchService
{
    public static function search($query, $count = 10, $source = null)
    {
        $sources = $source ? [$source] : ['unsplash', 'pexels', 'pixabay'];
        $allResults = [];

        foreach ($sources as $src) {
            try {
                switch ($src) {
                    case 'unsplash':
                        $results = self::searchUnsplash($query, $count);
                        break;
                    case 'pexels':
                        $results = self::searchPexels($query, $count);
                        break;
                    case 'pixabay':
                        $results = self::searchPixabay($query, $count);
                        break;
                    default:
                        $results = [];
                }
                $allResults = array_merge($allResults, $results);
                if (count($allResults) >= $count) break;
            } catch (\Exception $e) {
                Log::error("ImageSearch: {$src} failed: " . $e->getMessage());
            }
        }

        return array_slice($allResults, 0, $count);
    }

    public static function searchUnsplash($query, $count = 10)
    {
        $accessKey = config('services.unsplash.access_key', env('UNSPLASH_ACCESS_KEY'));
        if (!$accessKey) return [];

        $response = Http::withHeaders([
            'Authorization' => "Client-ID {$accessKey}",
            'Accept-Version' => 'v1',
        ])->get('https://api.unsplash.com/search/photos', [
            'query' => $query,
            'per_page' => min($count, 30),
            'orientation' => 'landscape',
            'content_filter' => 'high',
        ]);

        if ($response->status() === 403) {
            Log::warning('Unsplash API rate limit exceeded');
            return [];
        }

        if (!$response->successful()) return [];

        return collect($response->json('results', []))->map(function ($item) {
            return [
                'url' => $item['urls']['regular'] ?? null,
                'raw_url' => $item['urls']['raw'] ?? null,
                'full_url' => $item['urls']['full'] ?? null,
                'thumbnail' => $item['urls']['thumb'] ?? null,
                'small' => $item['urls']['small'] ?? null,
                'source' => 'unsplash',
                'credit' => $item['user']['name'] ?? 'Unknown',
                'credit_link' => $item['user']['links']['html'] ?? null,
                'width' => $item['width'] ?? null,
                'height' => $item['height'] ?? null,
                'alt' => $item['alt_description'] ?? '',
                'id' => $item['id'] ?? null,
                'download_location' => $item['links']['download_location'] ?? null,
            ];
        })->filter(fn($i) => !empty($i['url']))->values()->toArray();
    }

    public static function searchPexels($query, $count = 10)
    {
        $apiKey = config('services.pexels.api_key', env('PEXELS_API_KEY'));
        if (!$apiKey) return [];

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get('https://api.pexels.com/v1/search', [
            'query' => $query,
            'per_page' => min($count, 30),
        ]);

        if (!$response->successful()) return [];

        return collect($response->json('photos', []))->map(function ($item) {
            return [
                'url' => $item['src']['large'] ?? $item['src']['original'] ?? null,
                'thumbnail' => $item['src']['tiny'] ?? $item['src']['small'] ?? null,
                'source' => 'pexels',
                'credit' => $item['photographer'] ?? 'Unknown',
                'credit_link' => $item['photographer_url'] ?? null,
                'width' => $item['width'] ?? null,
                'height' => $item['height'] ?? null,
                'alt' => $item['alt'] ?? '',
                'id' => $item['id'] ?? null,
                'download_location' => null,
            ];
        })->filter(fn($i) => !empty($i['url']))->values()->toArray();
    }

    public static function searchPixabay($query, $count = 10)
    {
        $apiKey = config('services.pixabay.api_key', env('PIXABAY_API_KEY'));
        if (!$apiKey) return [];

        $response = Http::get('https://pixabay.com/api/', [
            'key' => $apiKey,
            'q' => $query,
            'per_page' => min($count, 30),
            'image_type' => 'photo',
            'orientation' => 'horizontal',
            'safesearch' => true,
        ]);

        if (!$response->successful()) return [];

        return collect($response->json('hits', []))->map(function ($item) {
            return [
                'url' => $item['largeImageURL'] ?? null,
                'thumbnail' => $item['previewURL'] ?? null,
                'source' => 'pixabay',
                'credit' => $item['user'] ?? 'Unknown',
                'credit_link' => null,
                'width' => $item['imageWidth'] ?? null,
                'height' => $item['imageHeight'] ?? null,
                'alt' => $item['tags'] ?? '',
                'id' => $item['id'] ?? null,
                'download_location' => null,
            ];
        })->filter(fn($i) => !empty($i['url']))->values()->toArray();
    }

    public static function generateKeywords($productName)
    {
        $keywords = [];
        $name = strtolower($productName);

        $keywords[] = $name;
        $keywords[] = "{$name} product";
        $keywords[] = "{$name} packaging";

        $categoryMap = [
            'rice' => ['rice bag', 'rice packaging', 'rice mill', 'premium rice', 'bangladesh rice'],
            'flour' => ['flour packaging', 'flour mill', 'wheat flour', 'flour bag'],
            'wheat' => ['wheat grain', 'wheat field', 'wheat packaging', 'wheat product'],
            'fish' => ['frozen fish', 'fish packaging', 'seafood', 'fish export'],
            'spice' => ['spices', 'spice packaging', 'whole spices', 'ground spices'],
            'chilli' => ['chilli powder', 'red chilli', 'spice powder', 'chilli packaging'],
            'turmeric' => ['turmeric powder', 'turmeric finger', 'turmeric packaging'],
            'ginger' => ['ginger root', 'dried ginger', 'ginger packaging'],
            'garlic' => ['garlic cloves', 'garlic packaging', 'dried garlic'],
            'onion' => ['onion bag', 'dried onion', 'onion packaging'],
            'oil' => ['cooking oil', 'oil bottle', 'oil packaging'],
            'lentil' => ['lentils', 'dal', 'lentil packaging', 'pulses'],
            'bean' => ['beans', 'dried beans', 'bean packaging'],
            'nut' => ['nuts', 'betel nut', 'dried nuts', 'nut packaging'],
            'betel' => ['betel nut', 'betel leaf', 'nut packaging', 'areca nut'],
            'shrimp' => ['shrimp', 'frozen shrimp', 'dried shrimp', 'seafood packaging'],
            'anchovy' => ['dried anchovy', 'anchovy packaging', 'fish product'],
            'tamarind' => ['tamarind', 'tamarind packaging', 'dried tamarind'],
            'turmeric' => ['turmeric powder', 'turmeric finger', 'turmeric root'],
            'ginger' => ['ginger root', 'dried ginger', 'ginger packaging'],
            'garlic' => ['garlic cloves', 'garlic packaging', 'dried garlic'],
            'raisin' => ['raisins', 'dried fruit packaging', 'kismis'],
            'licorice' => ['licorice root', 'mulethi', 'herbal root'],
            'fenugreek' => ['fenugreek seeds', 'methi', 'fenugreek packaging'],
            'chilli' => ['dried chilli', 'red chilli', 'chilli packaging'],
            'coriander' => ['coriander seeds', 'dhania', 'coriander packaging'],
            'cumin' => ['cumin seeds', 'jeera', 'cumin packaging'],
            'pepper' => ['black pepper', 'pepper packaging', 'whole pepper'],
            'salt' => ['rock salt', 'salt packaging', 'black salt'],
            'niger' => ['niger seeds', 'ramtil', 'seed packaging'],
            'groundnut' => ['groundnut', 'peanut', 'nut packaging'],
            'corn' => ['dry corn', 'maize', 'corn packaging'],
            'broom' => ['broom stick', 'broom grass', 'broom making'],
            'gum' => ['natural gum', 'gum arabic', 'edible gum'],
            'plum' => ['dried plum', 'sweet plum', 'dried fruit'],
            'gooseberry' => ['dried gooseberry', 'amla', 'amla powder'],
        ];

        foreach ($categoryMap as $word => $suggestions) {
            if (str_contains($name, $word)) {
                $keywords = array_merge($keywords, $suggestions);
            }
        }

        $keywords[] = 'bangladesh export product';
        $keywords[] = 'agro product photography';
        $keywords[] = 'food product packaging';
        $keywords[] = 'agriculture commodity';

        return array_unique($keywords);
    }
}
