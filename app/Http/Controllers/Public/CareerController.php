<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::active()->get();
        $departments = $careers->pluck('department')->unique();
        return view('pages.career.index', compact('careers', 'departments'));
    }

    public function show($slug)
    {
        $career = Career::where('slug', $slug)->firstOrFail();
        return view('pages.career.show', compact('career'));
    }

    public function apply(Request $request, $slug)
    {
        $career = Career::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'cover_letter' => 'nullable|string',
        ]);

        $application = new JobApplication($validated);
        $application->career_id = $career->id;
        $application->save();

        return redirect()->back()->with('success', 'Application submitted successfully. We will contact you.');
    }
}
