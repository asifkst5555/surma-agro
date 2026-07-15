<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:newsletters,email',
        ]);

        Newsletter::create($validated);

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
