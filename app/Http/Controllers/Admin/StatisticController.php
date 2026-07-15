<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::latest()->paginate(20);
        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'icon' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Statistic::create($validated);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic created.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'icon' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $statistic->update($validated);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic updated.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();
        return back()->with('success', 'Statistic deleted.');
    }
}
