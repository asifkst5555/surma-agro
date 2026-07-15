<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ImageDownload;
use App\Models\SearchHistory;
use App\Services\Image\ImageSearchService;
use App\Services\Image\ImageDownloadService;
use App\Services\Image\ImageCollectionService;
use App\Services\UnsplashImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageManagerController extends Controller
{
    public function index()
    {
        $recentImages = ProductImage::latest()->take(20)->get();
        $stats = [
            'total_images' => ProductImage::count(),
            'total_downloads' => ImageDownload::count(),
            'pending_downloads' => ImageDownload::where('status', 'pending')->count(),
            'products_with_images' => ProductImage::where('is_primary', true)->distinct('product_id')->count('product_id'),
        ];
        return view('admin.image-manager.index', compact('recentImages', 'stats'));
    }

    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|max:255']);
        $source = $request->get('source', 'unsplash');
        $count = (int) ($request->count ?? 20);

        $results = match ($source) {
            'pexels' => \App\Services\PexelsImageService::search($request->q, $count),
            'pixabay' => \App\Services\PixabayImageService::search($request->q, $count),
            default => UnsplashImageService::search($request->q, $count),
        };

        return response()->json(['results' => $results, 'source' => $source]);
    }

    public function download(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'product_id' => 'nullable|exists:products,id',
            'product_name' => 'nullable|string|max:255',
            'subfolder' => 'nullable|string|in:hero,products,gallery,factory,about,export,blog,banners,uploads',
        ]);

        try {
            $subfolder = $request->subfolder ?? 'uploads';
            $result = ImageDownloadService::downloadWithThumbnail(
                $request->url,
                $request->product_name ?? 'ai-image',
                $subfolder
            );

            $analysis = \App\Services\Image\ImageAnalyzeService::analyze($result['path']);
            $optimized = \App\Services\Image\ImageOptimizeService::optimize($result['path']);
            $thumbnail = \App\Services\Image\ImageOptimizeService::createThumbnail($optimized);

            $image = ProductImage::create([
                'product_id' => $request->product_id,
                'image_path' => $optimized,
                'thumbnail_path' => $thumbnail,
                'original_url' => $request->url,
                'source' => 'unsplash',
                'width' => $result['width'],
                'height' => $result['height'],
                'file_size' => $result['file_size'],
                'mime_type' => 'image/webp',
                'is_active' => true,
                'type' => $subfolder,
                'metadata' => $analysis,
            ]);

            ImageDownload::create([
                'product_id' => $request->product_id,
                'source' => 'unsplash',
                'original_url' => $request->url,
                'local_path' => $optimized,
                'status' => 'completed',
            ]);

            return response()->json(['success' => true, 'image' => $image->load('product')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function assign(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:product_images,id',
            'product_id' => 'required|exists:products,id',
            'is_primary' => 'boolean',
        ]);

        $image = ProductImage::findOrFail($request->image_id);
        $image->product_id = $request->product_id;

        if ($request->is_primary) {
            ProductImage::where('product_id', $request->product_id)
                ->where('is_primary', true)
                ->update(['is_primary' => false]);
            $image->is_primary = true;
        }

        $image->save();
        return response()->json(['success' => true, 'image' => $image->fresh()->load('product')]);
    }

    public function destroy($id)
    {
        $image = ProductImage::findOrFail($id);
        Storage::disk('public')->delete([$image->image_path, $image->thumbnail_path]);
        $image->delete();
        return back()->with('success', 'Image deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'exists:product_images,id']);
        $images = ProductImage::whereIn('id', $request->ids)->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete([$image->image_path, $image->thumbnail_path]);
            $image->delete();
        }
        return response()->json(['success' => true, 'deleted' => count($images)]);
    }

    public function productImages(Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->latest()->get();
        return response()->json(['images' => $images]);
    }

    public function collectForProduct(Request $request, Product $product)
    {
        $count = (int) ($request->count ?? 5);
        try {
            $downloaded = UnsplashImageService::collectForProduct($product, $count);
            return response()->json(['success' => true, 'downloaded' => $downloaded]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function setPrimary($id)
    {
        $image = ProductImage::findOrFail($id);
        ProductImage::where('product_id', $image->product_id)
            ->where('is_primary', true)
            ->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);
        return back()->with('success', 'Primary image updated.');
    }

    public function gallery(Request $request)
    {
        $images = ProductImage::latest()->paginate(30);

        if ($request->wantsJson() || $request->get('format') === 'json') {
            return response()->json(['images' => ProductImage::latest()->take(100)->get()]);
        }

        return view('admin.image-manager.gallery', compact('images'));
    }

    public function history()
    {
        $searches = SearchHistory::latest()->paginate(20);
        return view('admin.image-manager.history', compact('searches'));
    }

    public function suggestForProduct(Product $product)
    {
        $keywords = UnsplashImageService::generateKeywords($product->name);
        $results = [];
        foreach ($keywords as $keyword) {
            $images = UnsplashImageService::search($keyword, 5);
            $results = array_merge($results, $images);
            if (count($results) >= 15) break;
        }
        return response()->json(['keywords' => $keywords, 'results' => array_slice($results, 0, 15)]);
    }
}
