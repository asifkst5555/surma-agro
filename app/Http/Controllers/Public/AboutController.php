<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $team = TeamMember::active()->ordered()->get();
        return view('pages.about.index', compact('team'));
    }

    public function team()
    {
        $members = TeamMember::active()->ordered()->get();
        $managingDirector = $members->firstWhere('designation', 'Managing Director');
        $members = $members->reject(fn($m) => $m->id === ($managingDirector?->id));
        return view('pages.team.index', compact('members', 'managingDirector'));
    }
}
