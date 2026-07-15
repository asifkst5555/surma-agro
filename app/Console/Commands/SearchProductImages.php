<?php
namespace App\Console\Commands;

use App\Models\Product;
use App\Services\Image\ImageSearchService;
use App\Services\UnsplashImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SearchProductImages extends Command
{
    protected $signature = 'ai:search-products
        {query? : Custom search query}
        {--product= : Search for a specific product by ID}
        {--source= : Image source (unsplash, pexels, pixabay)}
        {--count=20 : Number of results}
        {--download : Also download the results}
        {--subfolder= : Subfolder to save downloads to}';

    protected $description = 'Search for product images using AI-generated keywords from Unsplash';

    public function handle(): int
    {
        $count = (int) $this->option('count');
        $query = $this->argument('query');

        if ($query) {
            $this->searchAndDisplay($query, $count);
            return Command::SUCCESS;
        }

        if ($productId = $this->option('product')) {
            $product = Product::find($productId);
            if (!$product) {
                $this->error("Product not found: {$productId}");
                return Command::FAILURE;
            }

            $this->info("Generating keywords for: {$product->name}");
            $keywords = UnsplashImageService::generateKeywords($product->name);
            $this->line('Keywords: ' . implode(', ', $keywords));
            $this->newLine();

            foreach (array_slice($keywords, 0, 5) as $keyword) {
                $this->searchAndDisplay($keyword, $count, $product);
            }

            return Command::SUCCESS;
        }

        $this->error('Please provide a query string or --product option.');
        $this->newLine();
        $this->info('Examples:');
        $this->line('  php artisan ai:search-products "rice mill"');
        $this->line('  php artisan ai:search-products "premium rice" --count=30');
        $this->line('  php artisan ai:search-products --product=1');
        $this->line('  php artisan ai:search-products "agro factory" --download --subfolder=factory');

        return Command::FAILURE;
    }

    private function searchAndDisplay(string $query, int $count, ?Product $product = null): void
    {
        $source = $this->option('source');

        $this->newLine();
        $this->info("Searching: \"{$query}\"" . ($source ? " on {$source}" : ' on Unsplash'));

        $results = $source
            ? ImageSearchService::search($query, $count, $source)
            : UnsplashImageService::search($query, $count);

        if (empty($results)) {
            $this->warn('No results found.');
            return;
        }

        $rows = [];
        foreach ($results as $i => $img) {
            $rows[] = [
                $i + 1,
                $img['source'] ?? 'unsplash',
                ($img['width'] ?? '?') . 'x' . ($img['height'] ?? '?'),
                $img['credit'] ?? 'Unknown',
                Str::limit($img['url'] ?? '', 60),
            ];
        }

        $this->table(['#', 'Source', 'Size', 'Photographer', 'URL'], $rows);

        if ($this->option('download') && $product) {
            $this->newLine();
            $this->info("Downloading images...");

            $subfolder = $this->option('subfolder') ?: 'products';
            $downloaded = 0;

            foreach ($results as $img) {
                try {
                    \App\Jobs\DownloadUnsplashImage::dispatch(
                        $img['url'],
                        $product->id,
                        $product->name,
                        $subfolder,
                        $img['alt'] ?? $product->name,
                        $img['download_location'] ?? null,
                    );
                    $downloaded++;
                } catch (\Exception $e) {
                    $this->error("Failed: {$e->getMessage()}");
                }
            }

            $this->info("Dispatched {$downloaded} download jobs for: {$product->name}");
        } elseif ($this->option('download')) {
            $this->warn('--download requires --product for assignment.');
        }
    }
}
