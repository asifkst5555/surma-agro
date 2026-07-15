<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()->latest('published_at')->paginate(9);
        return view('pages.blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $recent = Blog::published()->where('id', '!=', $blog->id)->latest('published_at')->take(4)->get();
        return view('pages.blog.show', compact('blog', 'recent'));
    }
}
