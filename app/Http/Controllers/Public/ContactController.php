<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $inquiry = new Inquiry($validated);
        $inquiry->type = 'general';
        $inquiry->save();

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you within 24 hours.');
    }
}
