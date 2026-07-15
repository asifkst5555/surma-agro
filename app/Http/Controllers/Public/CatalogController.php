<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::active()->ordered()->get();
        // Load first batch of products per category for initial render
        $categoriesWithProducts = $categories->map(function ($category) {
            $category->initial_products = Product::active()
                ->where('category_id', $category->id)
                ->with('primaryImage')
                ->take(8)
                ->get();
            $category->total_products = Product::active()
                ->where('category_id', $category->id)
                ->count();
            return $category;
        });

        return view('pages.catalog.index', compact('categories', 'categoriesWithProducts'));
    }

    /**
     * API endpoint for lazy loading more products in a category
     */
    public function loadMore(Request $request, $categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $offset = (int) $request->get('offset', 0);
        $limit = (int) $request->get('limit', 8);

        $products = Product::active()
            ->where('category_id', $category->id)
            ->with('primaryImage')
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($products as $product) {
            $html .= view('components.product-card', ['product' => $product])->render();
        }

        $hasMore = Product::active()
            ->where('category_id', $category->id)
            ->count() > ($offset + $limit);

        return response()->json([
            'html' => $html,
            'hasMore' => $hasMore,
            'loaded' => $offset + $products->count(),
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::active()
            ->where('category_id', $category->id)
            ->with('primaryImage')
            ->take(12)
            ->get();
        $totalProducts = Product::active()->where('category_id', $category->id)->count();
        $categories = Category::active()->ordered()->get();
        return view('pages.catalog.category', compact('category', 'products', 'categories', 'totalProducts'));
    }

    public function product($categorySlug, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->with(['category', 'images'])->firstOrFail();
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('primaryImage')
            ->take(4)
            ->get();
        return view('pages.catalog.product', compact('product', 'relatedProducts'));
    }

    public function inquiry(Request $request, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $inquiry = new Inquiry($validated);
        $inquiry->product_id = $product->id;
        $inquiry->type = 'product';
        $inquiry->save();

        return redirect()->back()->with('success', 'Your inquiry has been submitted. We will contact you shortly.');
    }

    public function surmaFish()
    {
        $category = Category::where('slug', 'surma-fish-products')->first();
        $products = $category ? Product::active()->where('category_id', $category->id)->get() : collect();
        return view('pages.surma-fish.index', compact('category', 'products'));
    }

    public function changeBox()
    {
        $category = Category::where('slug', 'change-box-products')->first();
        $products = $category ? Product::active()->where('category_id', $category->id)->get() : collect();
        return view('pages.change-box.index', compact('category', 'products'));
    }
}
