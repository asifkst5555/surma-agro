<?php
namespace App\Services;

use App\Models\ProductImage;
use App\Models\ImageDownload;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;

class UnsplashImageService
{
    protected static function getApiKey(): ?string
    {
        // First try database settings (admin-configured), then config/env
        $dbKey = \App\Models\Setting::getValue('unsplash_access_key');
        if ($dbKey) return $dbKey;
        return config('services.unsplash.access_key', env('UNSPLASH_ACCESS_KEY'));
    }

    public static function search(string $query, int $count = 30, string $orientation = 'landscape'): array
    {
        $apiKey = self::getApiKey();
        if (!$apiKey) {
            Log::error('UnsplashImageService: No API key configured');
            return [];
        }

        $allResults = [];
        $page = 1;
        $perPage = min(30, $count);

        while (count($allResults) < $count && $page <= 3) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => "Client-ID {$apiKey}",
                    'Accept-Version' => 'v1',
                ])->get('https://api.unsplash.com/search/photos', [
                    'query' => $query,
                    'per_page' => $perPage,
                    'page' => $page,
                    'orientation' => $orientation,
                    'content_filter' => 'high',
                ]);

                if (!$response->successful()) {
                    Log::warning("Unsplash API error (page {$page}): " . $response->body());
                    break;
                }

                $results = collect($response->json('results', []))->map(function ($item) {
                    return [
                        'id' => $item['id'] ?? null,
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
                        'alt' => $item['alt_description'] ?? $item['description'] ?? '',
                        'color' => $item['color'] ?? null,
                        'blur_hash' => $item['blur_hash'] ?? null,
                        'download_location' => $item['links']['download_location'] ?? null,
                    ];
                })->filter(fn($i) => !empty($i['url']))->values()->toArray();

                $allResults = array_merge($allResults, $results);
                $page++;

                if (count($results) < $perPage) break;
            } catch (\Exception $e) {
                Log::error("UnsplashImageService search error: " . $e->getMessage());
                break;
            }
        }

        return array_slice($allResults, 0, $count);
    }

    public static function download(string $imageUrl, string $productName = null, string $subfolder = 'products'): array
    {
        $downloadLocation = null;
        $args = func_get_args();
        if (isset($args[3])) {
            $downloadLocation = $args[3];
        }

        $response = Http::timeout(60)->get($imageUrl);
        if (!$response->successful()) {
            throw new \Exception("Failed to download image from {$imageUrl}");
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
        $subPath = "ai-images/{$subfolder}/{$filename}";
        Storage::disk('public')->put($subPath, $imageContent);

        $fullPath = Storage::disk('public')->path($subPath);
        $imageSize = @getimagesize($fullPath);

        $result = [
            'path' => $subPath,
            'filename' => $filename,
            'mime_type' => $mimeType,
            'width' => $imageSize[0] ?? null,
            'height' => $imageSize[1] ?? null,
            'file_size' => strlen($imageContent),
            'full_path' => $fullPath,
        ];

        if ($downloadLocation) {
            self::trackDownload($downloadLocation);
        }

        return $result;
    }

    public static function downloadWithThumbnail(string $imageUrl, string $productName = null, string $subfolder = 'products', string $downloadLocation = null): array
    {
        $result = self::download($imageUrl, $productName, $subfolder, $downloadLocation);

        try {
            $img = \Intervention\Image\Laravel\Facades\Image::decode($result['full_path']);
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $thumbFilename = 'thumb_' . $result['filename'];
            $thumbPath = "ai-images/thumbnails/{$thumbFilename}";
            $thumbEncoded = $img->encodeUsingFormat(Format::WEBP, quality: 70);
            Storage::disk('public')->put($thumbPath, (string) $thumbEncoded);
            $result['thumbnail_path'] = $thumbPath;
        } catch (\Exception $e) {
            $result['thumbnail_path'] = $result['path'];
        }

        return $result;
    }

    public static function collectForProduct($product, int $count = 5): int
    {
        $keywords = self::generateKeywords($product->name);
        $results = [];

        foreach ($keywords as $keyword) {
            $images = self::search($keyword, $count);
            $results = array_merge($results, $images);
            if (count($results) >= $count * 3) break;
        }

        $results = array_slice($results, 0, $count * 3);

        SearchHistory::create([
            'product_id' => $product->id,
            'query' => implode(', ', array_slice($keywords, 0, 3)),
            'source' => 'unsplash',
            'results_count' => count($results),
        ]);

        $downloaded = 0;
        foreach ($results as $image) {
            if ($downloaded >= $count) break;

            $existing = ProductImage::where('original_url', $image['url'])->first();
            if ($existing) continue;

            $downloadRecord = ImageDownload::create([
                'product_id' => $product->id,
                'search_query' => $keywords[0] ?? $product->name,
                'source' => 'unsplash',
                'original_url' => $image['url'],
                'status' => 'pending',
            ]);

            try {
                $downloadResult = self::downloadWithThumbnail(
                    $image['url'],
                    $product->name,
                    'products',
                    $image['download_location'] ?? null
                );

                $analysis = \App\Services\Image\ImageAnalyzeService::analyze($downloadResult['path']);
                if (!$analysis['pass']) {
                    Storage::disk('public')->delete($downloadResult['path']);
                    if (isset($downloadResult['thumbnail_path'])) {
                        Storage::disk('public')->delete($downloadResult['thumbnail_path']);
                    }
                    $downloadRecord->update([
                        'status' => 'failed',
                        'error_message' => 'Quality check failed: ' . implode(', ', $analysis['issues']),
                    ]);
                    continue;
                }

                $optimized = \App\Services\Image\ImageOptimizeService::optimize($downloadResult['path']);
                $thumbnail = \App\Services\Image\ImageOptimizeService::createThumbnail($optimized);

                $isPrimary = !ProductImage::where('product_id', $product->id)->where('is_primary', true)->exists();

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $optimized,
                    'thumbnail_path' => $thumbnail,
                    'original_url' => $image['url'],
                    'source' => 'unsplash',
                    'width' => $analysis['width'],
                    'height' => $analysis['height'],
                    'file_size' => $analysis['file_size'],
                    'mime_type' => 'image/webp',
                    'is_primary' => $isPrimary,
                    'is_active' => true,
                    'type' => 'product',
                    'alt_text' => $image['alt'] ?: "{$product->name} - Surma Agro",
                    'metadata' => $image,
                ]);

                $downloadRecord->update([
                    'status' => 'completed',
                    'local_path' => $optimized,
                ]);

                $downloaded++;
            } catch (\Exception $e) {
                Log::error("UnsplashImageService: Failed to download for {$product->name}: " . $e->getMessage());
                if (isset($downloadRecord)) {
                    $downloadRecord->update([
                        'status' => 'failed',
                        'error_message' => $e->getMessage(),
                    ]);
                }
            }
        }

        return $downloaded;
    }

    public static function collectByQuery(string $query, string $subfolder = 'hero', int $count = 20, ?string $altText = null): array
    {
        $images = self::search($query, $count);
        $results = [];

        Storage::disk('public')->makeDirectory("ai-images/{$subfolder}");

        foreach ($images as $image) {
            $existing = ProductImage::where('original_url', $image['url'])->first();
            if ($existing) {
                $results[] = ['status' => 'skipped', 'path' => $existing->image_path, 'reason' => 'duplicate'];
                continue;
            }

            try {
                $downloadResult = self::downloadWithThumbnail(
                    $image['url'],
                    $query,
                    $subfolder,
                    $image['download_location'] ?? null
                );

                $analysis = \App\Services\Image\ImageAnalyzeService::analyze($downloadResult['path']);
                if (!$analysis['pass']) {
                    Storage::disk('public')->delete($downloadResult['path']);
                    if (isset($downloadResult['thumbnail_path'])) {
                        Storage::disk('public')->delete($downloadResult['thumbnail_path']);
                    }
                    $results[] = ['status' => 'failed', 'reason' => implode(', ', $analysis['issues'])];
                    continue;
                }

                $optimized = \App\Services\Image\ImageOptimizeService::optimize($downloadResult['path']);
                $thumbnail = \App\Services\Image\ImageOptimizeService::createThumbnail($optimized);

                ProductImage::create([
                    'image_path' => $optimized,
                    'thumbnail_path' => $thumbnail,
                    'original_url' => $image['url'],
                    'source' => 'unsplash',
                    'width' => $analysis['width'],
                    'height' => $analysis['height'],
                    'file_size' => $analysis['file_size'],
                    'mime_type' => 'image/webp',
                    'is_active' => true,
                    'type' => $subfolder,
                    'alt_text' => $altText ?: ($image['alt'] ?: $query),
                    'metadata' => $image,
                ]);

                $results[] = ['status' => 'downloaded', 'path' => $optimized];
            } catch (\Exception $e) {
                Log::error("UnsplashImageService collectByQuery: {$e->getMessage()}");
                $results[] = ['status' => 'error', 'reason' => $e->getMessage()];
            }
        }

        SearchHistory::create([
            'query' => $query,
            'source' => 'unsplash',
            'results_count' => count($images),
            'downloaded_count' => count(array_filter($results, fn($r) => $r['status'] === 'downloaded')),
        ]);

        return $results;
    }

    public static function generateKeywords(string $productName): array
    {
        $keywords = [];
        $name = strtolower($productName);

        $keywords[] = $name;
        $keywords[] = "{$name} product";
        $keywords[] = "{$name} packaging";

        $agroKeywords = [
            'rice' => ['rice mill industry', 'premium rice bag', 'rice processing factory', 'bangladesh rice export', 'paddy rice field', 'rice packaging product'],
            'flour' => ['flour mill production', 'wheat flour packaging', 'flour processing plant', 'industrial flour bag'],
            'wheat' => ['wheat grain harvest', 'wheat field agriculture', 'wheat flour packaging', 'wheat product mill'],
            'fish' => ['frozen fish processing', 'seafood export packaging', 'fish processing plant', 'commercial fishing industry'],
            'spice' => ['spice processing factory', 'ground spice packaging', 'spice export product', 'industrial spice mill'],
            'chilli' => ['chilli powder processing', 'red chilli drying', 'spice grinding factory'],
            'turmeric' => ['turmeric powder processing', 'turmeric farming', 'turmeric export product'],
            'ginger' => ['ginger farming', 'dried ginger processing', 'ginger export packaging'],
            'garlic' => ['garlic processing', 'garlic packaging export', 'garlic wholesale'],
            'onion' => ['onion packing', 'onion export bag', 'onion wholesale market'],
            'shrimp' => ['shrimp processing plant', 'frozen shrimp packaging', 'shrimp export industry', 'prawn farming'],
            'bean' => ['bean sorting', 'dried bean packaging', 'bean export processing'],
            'nut' => ['nut processing factory', 'dried nut packaging', 'betel nut sorting'],
            'anchovy' => ['dried fish processing', 'anchovy drying', 'fish export packaging'],
            'oil' => ['cooking oil bottling', 'oil refinery plant', 'edible oil packaging'],
            'lentil' => ['lentil sorting', 'dal processing', 'pulse packaging'],
        ];

        foreach ($agroKeywords as $word => $suggestions) {
            if (str_contains($name, $word)) {
                $keywords = array_merge($keywords, $suggestions);
            }
        }

        $keywords = array_merge($keywords, [
            'agro processing industry',
            'food manufacturing plant',
            'industrial agriculture',
            'export quality product',
            'bangladesh agro export',
            'warehouse storage',
            'food production line',
        ]);

        return array_values(array_unique($keywords));
    }

    public static function getPhoto(string $photoId): ?array
    {
        $apiKey = self::getApiKey();
        if (!$apiKey) return null;

        try {
            $response = Http::withHeaders([
                'Authorization' => "Client-ID {$apiKey}",
                'Accept-Version' => 'v1',
            ])->get("https://api.unsplash.com/photos/{$photoId}");

            if (!$response->successful()) return null;

            $item = $response->json();
            return [
                'id' => $item['id'] ?? null,
                'url' => $item['urls']['regular'] ?? null,
                'raw_url' => $item['urls']['raw'] ?? null,
                'full_url' => $item['urls']['full'] ?? null,
                'thumbnail' => $item['urls']['thumb'] ?? null,
                'source' => 'unsplash',
                'credit' => $item['user']['name'] ?? 'Unknown',
                'width' => $item['width'] ?? null,
                'height' => $item['height'] ?? null,
                'alt' => $item['alt_description'] ?? '',
                'download_location' => $item['links']['download_location'] ?? null,
            ];
        } catch (\Exception $e) {
            Log::error("UnsplashImageService getPhoto: " . $e->getMessage());
            return null;
        }
    }

    public static function listCollections(string $query = null, int $count = 10): array
    {
        $apiKey = self::getApiKey();
        if (!$apiKey) return [];

        try {
            $params = ['per_page' => min($count, 30)];
            if ($query) $params['query'] = $query;

            $endpoint = $query
                ? 'https://api.unsplash.com/search/collections'
                : 'https://api.unsplash.com/collections';

            $response = Http::withHeaders([
                'Authorization' => "Client-ID {$apiKey}",
                'Accept-Version' => 'v1',
            ])->get($endpoint, $params);

            if (!$response->successful()) return [];

            $items = $query ? $response->json('results', []) : $response->json([], []);
            return collect($items)->map(fn($c) => [
                'id' => $c['id'],
                'title' => $c['title'],
                'description' => $c['description'],
                'total_photos' => $c['total_photos'],
                'cover_photo' => $c['cover_photo']['urls']['regular'] ?? null,
            ])->values()->toArray();
        } catch (\Exception $e) {
            Log::error("UnsplashImageService listCollections: " . $e->getMessage());
            return [];
        }
    }

    private static function trackDownload(string $downloadLocation): void
    {
        try {
            Http::withHeaders([
                'Authorization' => "Client-ID " . self::getApiKey(),
            ])->get($downloadLocation);
        } catch (\Exception $e) {
            // Silent - tracking is optional
        }
    }

    private static function generateFilename(?string $productName, string $extension): string
    {
        $slug = $productName ? Str::slug(substr($productName, 0, 50)) : 'unsplash-image';
        $unique = Str::random(10);
        return "{$slug}-{$unique}.{$extension}";
    }

    private static function mimeToExtension(string $mime): string
    {
        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            default => 'jpg',
        };
    }
}
