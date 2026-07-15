<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::latest()->paginate(20);
        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('admin.offices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'is_headquarters' => 'boolean',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Office::create($validated);

        return redirect()->route('admin.offices.index')->with('success', 'Office created.');
    }

    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'is_headquarters' => 'boolean',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $office->update($validated);

        return redirect()->route('admin.offices.index')->with('success', 'Office updated.');
    }

    public function destroy(Office $office)
    {
        $office->delete();
        return back()->with('success', 'Office deleted.');
    }
}
