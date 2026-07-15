<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->paginate(20);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return back()->with('success', 'Certificate deleted.');
    }
}
