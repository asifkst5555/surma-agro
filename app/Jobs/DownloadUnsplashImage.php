<?php
namespace App\Jobs;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ImageDownload;
use App\Services\UnsplashImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DownloadUnsplashImage implements ShouldQueue
{
    use Queueable;

    public int $timeout = 120;
    public int $tries = 3;

    public function __construct(
        public string $imageUrl,
        public ?int $productId = null,
        public ?string $productName = null,
        public string $subfolder = 'products',
        public ?string $altText = null,
        public ?string $downloadLocation = null,
    ) {}

    public function handle(): void
    {
        try {
            $existing = ProductImage::where('original_url', $this->imageUrl)->first();
            if ($existing) {
                Log::info("DownloadUnsplashImage: Skipping duplicate {$this->imageUrl}");
                return;
            }

            $downloadRecord = ImageDownload::create([
                'product_id' => $this->productId,
                'search_query' => $this->productName ?? $this->subfolder,
                'source' => 'unsplash',
                'original_url' => $this->imageUrl,
                'status' => 'downloading',
            ]);

            $result = UnsplashImageService::downloadWithThumbnail(
                $this->imageUrl,
                $this->productName,
                $this->subfolder,
                $this->downloadLocation,
            );

            $analysis = \App\Services\Image\ImageAnalyzeService::analyze($result['path']);
            if (!$analysis['pass']) {
                Storage::disk('public')->delete($result['path']);
                if (isset($result['thumbnail_path'])) {
                    Storage::disk('public')->delete($result['thumbnail_path']);
                }
                $downloadRecord->update([
                    'status' => 'failed',
                    'error_message' => 'Quality: ' . implode(', ', $analysis['issues']),
                ]);
                return;
            }

            $optimized = \App\Services\Image\ImageOptimizeService::optimize($result['path']);
            $thumbnail = \App\Services\Image\ImageOptimizeService::createThumbnail($optimized);

            $data = [
                'image_path' => $optimized,
                'thumbnail_path' => $thumbnail,
                'original_url' => $this->imageUrl,
                'source' => 'unsplash',
                'width' => $analysis['width'],
                'height' => $analysis['height'],
                'file_size' => $analysis['file_size'],
                'mime_type' => 'image/webp',
                'is_active' => true,
                'type' => $this->subfolder,
                'alt_text' => $this->altText ?: "{$this->productName} - Surma Agro",
            ];

            if ($this->productId) {
                $data['product_id'] = $this->productId;
                $data['is_primary'] = !ProductImage::where('product_id', $this->productId)
                    ->where('is_primary', true)->exists();
            }

            ProductImage::create($data);

            $downloadRecord->update([
                'status' => 'completed',
                'local_path' => $optimized,
            ]);

            Log::info("DownloadUnsplashImage: Completed {$this->imageUrl}");
        } catch (\Exception $e) {
            Log::error("DownloadUnsplashImage failed: " . $e->getMessage(), [
                'url' => $this->imageUrl,
                'product_id' => $this->productId,
            ]);

            if (isset($downloadRecord)) {
                $downloadRecord->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            }

            if ($this->attempts() >= $this->tries) {
                return;
            }

            throw $e;
        }
    }
}
