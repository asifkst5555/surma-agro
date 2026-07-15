<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->paginate(20);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['requirements'] = $validated['requirements'] ? array_map('trim', explode("\n", $validated['requirements'])) : null;
        $validated['benefits'] = $validated['benefits'] ? array_map('trim', explode("\n", $validated['benefits'])) : null;
        Career::create($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Job created.');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['requirements'] = $validated['requirements'] ? array_map('trim', explode("\n", $validated['requirements'])) : null;
        $validated['benefits'] = $validated['benefits'] ? array_map('trim', explode("\n", $validated['benefits'])) : null;
        $career->update($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Job updated.');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return back()->with('success', 'Job deleted.');
    }

    public function applications(Career $career)
    {
        $applications = $career->applications()->latest()->get();
        return view('admin.careers.applications', compact('career', 'applications'));
    }
}
