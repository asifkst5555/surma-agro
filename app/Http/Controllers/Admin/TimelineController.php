<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineEntry;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $entries = TimelineEntry::orderBy('year', 'desc')->paginate(20);
        return view('admin.timeline.index', compact('entries'));
    }

    public function create()
    {
        return view('admin.timeline.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        TimelineEntry::create($validated);

        return redirect()->route('admin.timeline.index')->with('success', 'Timeline entry created.');
    }

    public function edit(TimelineEntry $timeline)
    {
        return view('admin.timeline.edit', ['entry' => $timeline]);
    }

    public function update(Request $request, TimelineEntry $timeline)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $timeline->update($validated);

        return redirect()->route('admin.timeline.index')->with('success', 'Timeline entry updated.');
    }

    public function destroy(TimelineEntry $timeline)
    {
        $timeline->delete();
        return back()->with('success', 'Timeline entry deleted.');
    }
}
