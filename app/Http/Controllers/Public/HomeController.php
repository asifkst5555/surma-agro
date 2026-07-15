<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Statistic;
use App\Models\Certificate;
use App\Models\Testimonial;
use App\Models\Banner;
use App\Models\Office;
use App\Models\TeamMember;
use App\Models\TimelineEntry;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->ordered()->get()->groupBy('type');
        $statistics = Statistic::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $offices = Office::active()->ordered()->get();
        $featuredProducts = Product::active()->featured()->with(['category', 'primaryImage', 'images'])->take(8)->get();
        $banners = Banner::active()->byPage('home')->ordered()->get();

        return view('pages.home', compact(
            'categories', 'statistics', 'certificates',
            'testimonials', 'offices', 'featuredProducts', 'banners'
        ));
    }
}
