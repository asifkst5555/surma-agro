<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers = Newsletter::latest()->paginate(30);
        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function export()
    {
        $subscribers = Newsletter::all();
        $csv = "Email,Subscribed At\n";
        foreach ($subscribers as $sub) {
            $csv .= $sub->email . ',' . $sub->created_at . "\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="newsletter-subscribers.csv"');
    }
}
