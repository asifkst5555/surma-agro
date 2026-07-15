<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Office;

class PresenceController extends Controller
{
    public function index()
    {
        $offices = Office::active()->ordered()->get();
        $headOffice = $offices->firstWhere('is_head_office', true);
        return view('pages.presence.index', compact('offices', 'headOffice'));
    }
}
