<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TimelineEntry;

class TimelineController extends Controller
{
    public function index()
    {
        $entries = TimelineEntry::active()->ordered()->get();
        $years = $entries->groupBy('year');
        return view('pages.timeline.index', compact('entries', 'years'));
    }
}
