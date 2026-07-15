<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'origin' => 'nullable|string|max:255',
            'moq' => 'nullable|numeric',
            'packaging' => 'nullable|string|max:255',
            'export_capacity' => 'nullable|string|max:255',
            'shipment_details' => 'nullable|string|max:255',
            'shelf_life' => 'nullable|string|max:255',
            'specifications' => 'nullable|json',
            'featured_image' => 'nullable|string',
            'gallery' => 'nullable|json',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'origin' => 'nullable|string|max:255',
            'moq' => 'nullable|numeric',
            'packaging' => 'nullable|string|max:255',
            'export_capacity' => 'nullable|string|max:255',
            'shipment_details' => 'nullable|string|max:255',
            'shelf_life' => 'nullable|string|max:255',
            'specifications' => 'nullable|json',
            'featured_image' => 'nullable|string',
            'gallery' => 'nullable|json',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    /**
     * Upload images directly to a product
     */
    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,webp,gif|max:5120',
        ]);

        $uploaded = [];
        foreach ($request->file('images') as $file) {
            $name = \Illuminate\Support\Str::slug($product->name) . '-' . \Illuminate\Support\Str::random(8);
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = $name . '.' . $extension;

            // Store original
            $path = $file->storeAs('ai-images/products', $filename, 'public');

            // Store a copy as thumbnail (same file, no resize needed for now)
            $thumbFilename = $name . '-thumb.' . $extension;
            $thumbPath = 'ai-images/thumbnails/' . $thumbFilename;
            \Storage::disk('public')->put($thumbPath, file_get_contents($file->getRealPath()));

            $isPrimary = $product->images()->count() === 0 && count($uploaded) === 0;

            $imageSize = @getimagesize($file->getRealPath());

            $image = \App\Models\ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'thumbnail_path' => $thumbPath,
                'source' => 'upload',
                'width' => $imageSize[0] ?? null,
                'height' => $imageSize[1] ?? null,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'is_primary' => $isPrimary,
                'is_active' => true,
                'type' => 'products',
            ]);

            $uploaded[] = $image;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'images' => $uploaded, 'count' => count($uploaded)]);
        }

        return back()->with('success', count($uploaded) . ' image(s) uploaded.');
    }
}
