<?php
namespace App\Console\Commands;

use App\Models\Product;
use App\Services\Image\ImageSearchService;
use App\Services\Image\ImageDownloadService;
use App\Services\Image\ImageAnalyzeService;
use App\Services\Image\ImageOptimizeService;
use App\Services\Image\ImageCollectionService;
use App\Services\UnsplashImageService;
use App\Models\ProductImage;
use App\Models\ImageDownload;
use App\Models\SearchHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CollectImages extends Command
{
    protected $signature = 'ai:collect-images
        {query? : Direct search query (e.g. "rice mill", "agro factory")}
        {--product= : Specific product ID}
        {--category= : Category slug to filter products}
        {--subfolder= : Storage subfolder (hero, products, gallery, factory, about, export, blog, banners)}
        {--count=5 : Images per product}
        {--all : Collect for all products without images}
        {--queue : Dispatch jobs to queue instead of running synchronously}';

    protected $description = 'Collect images from Unsplash, Pexels, Pixabay for Surma Agro';

    public function handle(): int
    {
        $query = $this->argument('query');

        if ($query) {
            return $this->collectByQuery($query);
        }

        if ($this->option('product')) {
            return $this->collectForProduct((int) $this->option('product'));
        }

        if ($this->option('category')) {
            return $this->collectForCategory($this->option('category'));
        }

        if ($this->option('all')) {
            return $this->collectForAllProducts();
        }

        $this->warn('Please provide a query, --product, --category, or --all.');
        $this->newLine();
        $this->info('Examples:');
        $this->line('  php artisan ai:collect-images "rice mill"');
        $this->line('  php artisan ai:collect-images --product=1');
        $this->line('  php artisan ai:collect-images --category=export-items');
        $this->line('  php artisan ai:collect-images --all');

        return Command::SUCCESS;
    }

    protected function collectByQuery(string $query): int
    {
        $count = (int) $this->option('count');
        $subfolder = $this->option('subfolder') ?: 'hero';

        $this->info("Searching for: \"{$query}\"");
        $this->line("Target: {$count} images into ai-images/{$subfolder}");
        $this->newLine();

        $images = ImageSearchService::search($query, $count * 3);

        if (empty($images)) {
            $this->warn('No images found from any source.');
            return Command::SUCCESS;
        }

        $this->info("Found " . count($images) . " images from sources: " . implode(', ', array_unique(array_column($images, 'source'))));

        if ($this->option('queue')) {
            $dispatched = 0;
            foreach (array_slice($images, 0, $count) as $img) {
                \App\Jobs\DownloadUnsplashImage::dispatch(
                    $img['url'],
                    null,
                    $query,
                    $subfolder,
                    $img['alt'] ?? $query,
                    $img['download_location'] ?? null,
                );
                $dispatched++;
            }
            $this->info("Dispatched {$dispatched} download jobs to queue.");
            $this->line("Run: php artisan queue:work");
            return Command::SUCCESS;
        }

        Storage::disk('public')->makeDirectory("ai-images/{$subfolder}");

        $downloaded = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($images as $image) {
            if ($downloaded >= $count) break;

            $existing = ProductImage::where('original_url', $image['url'])->first();
            if ($existing) { $skipped++; continue; }

            try {
                $downloadResult = ImageDownloadService::downloadWithThumbnail(
                    $image['url'],
                    $query,
                    $subfolder
                );

                $analysis = ImageAnalyzeService::analyze($downloadResult['path']);
                if (!$analysis['pass']) {
                    Storage::disk('public')->delete([$downloadResult['path'], $downloadResult['thumbnail_path'] ?? '']);
                    $failed++;
                    continue;
                }

                $optimized = ImageOptimizeService::optimize($downloadResult['path']);
                $thumbnail = ImageOptimizeService::createThumbnail($optimized);

                ProductImage::create([
                    'image_path' => $optimized,
                    'thumbnail_path' => $thumbnail,
                    'original_url' => $image['url'],
                    'source' => $image['source'],
                    'width' => $analysis['width'] ?? $downloadResult['width'],
                    'height' => $analysis['height'] ?? $downloadResult['height'],
                    'file_size' => $analysis['file_size'] ?? $downloadResult['file_size'],
                    'mime_type' => 'image/webp',
                    'is_active' => true,
                    'type' => $subfolder,
                    'alt_text' => $image['alt'] ?: $query,
                    'metadata' => $analysis,
                ]);

                $downloaded++;
            } catch (\Exception $e) {
                $this->error("Download error: " . $e->getMessage());
                $failed++;
            }
        }

        SearchHistory::create([
            'query' => $query,
            'source' => 'multi',
            'results_count' => count($images),
            'downloaded_count' => $downloaded,
        ]);

        $this->newLine();
        $this->table(
            ['Result', 'Count'],
            [
                ['Downloaded', $downloaded],
                ['Skipped', $skipped],
                ['Failed', $failed],
            ]
        );

        $this->info("Saved to storage/app/public/ai-images/{$subfolder}/");
        return Command::SUCCESS;
    }

    protected function collectForProduct(int $productId): int
    {
        $product = Product::find($productId);
        if (!$product) { $this->error("Product not found: {$productId}"); return Command::FAILURE; }

        $count = (int) $this->option('count');
        $this->info("Collecting images for: {$product->name}");

        if ($this->option('queue')) {
            $keywords = ImageSearchService::generateKeywords($product->name);
            $dispatched = 0;
            foreach (array_slice($keywords, 0, 3) as $kw) {
                $images = ImageSearchService::search($kw, $count);
                foreach (array_slice($images, 0, $count) as $img) {
                    \App\Jobs\DownloadUnsplashImage::dispatch(
                        $img['url'],
                        $product->id,
                        $product->name,
                        'products',
                        $img['alt'] ?? $product->name,
                        $img['download_location'] ?? null,
                    );
                    $dispatched++;
                }
            }
            $this->info("Dispatched {$dispatched} download jobs to queue.");
            $this->line("Run: php artisan queue:work");
            return Command::SUCCESS;
        }

        $downloaded = ImageCollectionService::collectForProduct($product, $count);
        $this->info("Downloaded {$downloaded} images for: {$product->name}");
        return Command::SUCCESS;
    }

    protected function collectForCategory(string $slug): int
    {
        $products = Product::whereHas('category', fn($q) => $q->where('slug', $slug))->get();
        if ($products->isEmpty()) { $this->warn("No products in category: {$slug}"); return Command::SUCCESS; }

        $count = min((int) $this->option('count'), 3);
        $total = 0;

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        foreach ($products as $product) {
            try {
                $total += ImageCollectionService::collectForProduct($product, $count);
            } catch (\Exception $e) {
                $this->error("Failed for {$product->name}: {$e->getMessage()}");
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Total: {$total} images");
        return Command::SUCCESS;
    }

    protected function collectForAllProducts(): int
    {
        $products = Product::whereDoesntHave('images')->get();

        if ($products->isEmpty()) { $this->info('All products already have images.'); return Command::SUCCESS; }

        $this->info("Collecting images for {$products->count()} products...");

        $totalDownloaded = 0;
        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        foreach ($products as $product) {
            try {
                $downloaded = ImageCollectionService::collectForProduct($product, 3);
                $totalDownloaded += $downloaded;
            } catch (\Exception $e) {
                // continue
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Downloaded {$totalDownloaded} images total.");
        return Command::SUCCESS;
    }
}
