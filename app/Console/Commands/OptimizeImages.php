<?php
namespace App\Console\Commands;

use App\Models\ProductImage;
use App\Services\Image\ImageOptimizeService;
use App\Services\Image\ImageAnalyzeService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class OptimizeImages extends Command
{
    protected $signature = 'ai:optimize-images
        {--all : Re-optimize all images}
        {--dry-run : Show what would be done without making changes}
        {--type= : Filter by image type (product, hero, gallery, factory, about, export, blog, banners)}
        {--quality=80 : WebP quality (1-100)}';

    protected $description = 'Optimize all product images to WebP and generate thumbnails';

    public function handle(): int
    {
        $query = ProductImage::query();

        if ($type = $this->option('type')) {
            $query->where('type', $type);
            $this->info("Filtering by type: {$type}");
        }

        if (!$this->option('all')) {
            $query->where(function ($q) {
                $q->where('mime_type', '!=', 'image/webp')
                  ->orWhereNull('thumbnail_path');
            });
        }

        $images = $query->get();
        $this->info("Found {$images->count()} images to process.");

        if ($this->option('dry-run')) {
            if ($images->isEmpty()) {
                $this->warn('No images to process.');
                return Command::SUCCESS;
            }
            $this->table(
                ['ID', 'Type', 'Current Format', 'Width', 'Height', 'Has Thumbnail'],
                $images->map(fn($i) => [
                    $i->id,
                    $i->type ?? 'N/A',
                    $i->mime_type,
                    $i->width ?? '?',
                    $i->height ?? '?',
                    $i->thumbnail_path ? 'Yes' : 'No',
                ])
            );
            $this->newLine();
            $this->info('Run without --dry-run to process.');
            return Command::SUCCESS;
        }

        $quality = (int) $this->option('quality');
        $bar = $this->output->createProgressBar($images->count());
        $bar->start();

        $optimized = 0;
        $thumbnails = 0;

        foreach ($images as $image) {
            try {
                if (!Storage::disk('public')->exists($image->image_path)) {
                    $this->warn("File missing: {$image->image_path}");
                    $bar->advance();
                    continue;
                }

                if ($image->mime_type !== 'image/webp' || $this->option('all')) {
                    $newPath = ImageOptimizeService::optimize($image->image_path, $quality);
                    $image->image_path = $newPath;
                    $image->mime_type = 'image/webp';
                    $optimized++;
                }

                if (!$image->thumbnail_path || $this->option('all')) {
                    $thumb = ImageOptimizeService::createThumbnail($image->image_path);
                    $image->thumbnail_path = $thumb;
                    $thumbnails++;
                }

                $image->save();
            } catch (\Exception $e) {
                $this->error("Failed on image {$image->id}: {$e->getMessage()}");
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Done! Optimized: {$optimized}, Thumbnails created: {$thumbnails}");

        return Command::SUCCESS;
    }
}
