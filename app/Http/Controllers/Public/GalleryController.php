<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::active()->ordered()->get();
        $categories = $items->pluck('category')->unique()->filter();
        return view('pages.gallery.index', compact('items', 'categories'));
    }
}
