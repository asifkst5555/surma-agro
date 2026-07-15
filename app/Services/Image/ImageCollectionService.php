<?php
namespace App\Services\Image;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ImageDownload;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageCollectionService
{
    public static function collectForProduct(Product $product, $count = 5)
    {
        $keywords = ImageSearchService::generateKeywords($product->name);

        $results = [];
        foreach ($keywords as $keyword) {
            $images = ImageSearchService::search($keyword, $count);
            $results = array_merge($results, $images);
            if (count($results) >= $count * 3) break;
        }

        $results = array_slice($results, 0, $count * 3);

        // Save search history
        SearchHistory::create([
            'product_id' => $product->id,
            'query' => implode(', ', array_slice($keywords, 0, 3)),
            'source' => 'auto',
            'results_count' => count($results),
        ]);

        $downloaded = 0;
        foreach ($results as $image) {
            if ($downloaded >= $count) break;

            try {
                $downloadRecord = ImageDownload::create([
                    'product_id' => $product->id,
                    'search_query' => $keywords[0] ?? $product->name,
                    'source' => $image['source'],
                    'original_url' => $image['url'],
                    'status' => 'pending',
                ]);

                $downloadResult = ImageDownloadService::downloadWithThumbnail(
                    $image['url'],
                    $product->name,
                    'products'
                );

                $analysis = ImageAnalyzeService::analyze($downloadResult['path']);
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

                // Optimize to WebP
                $optimized = ImageOptimizeService::optimize($downloadResult['path']);
                $thumbnail = ImageOptimizeService::createThumbnail($optimized);

                $isPrimary = !ProductImage::where('product_id', $product->id)->where('is_primary', true)->exists();

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $optimized,
                    'thumbnail_path' => $thumbnail,
                    'original_url' => $image['url'],
                    'source' => $image['source'],
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
                Log::error("ImageCollection: Failed to download for {$product->name}: " . $e->getMessage());
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

    public static function collectBatch($productIds = [], $imagesPerProduct = 3)
    {
        $query = Product::query();
        if (!empty($productIds)) {
            $query->whereIn('id', $productIds);
        }

        $products = $query->get();
        $results = [];

        foreach ($products as $product) {
            try {
                $count = self::collectForProduct($product, $imagesPerProduct);
                $results[$product->id] = ['name' => $product->name, 'downloaded' => $count];
            } catch (\Exception $e) {
                Log::error("ImageCollection batch failed for {$product->name}: " . $e->getMessage());
                $results[$product->id] = ['name' => $product->name, 'error' => $e->getMessage()];
            }
        }

        return $results;
    }
}
