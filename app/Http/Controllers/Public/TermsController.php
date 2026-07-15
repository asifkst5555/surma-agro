<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function index()
    {
        return view('pages.terms.index');
    }
}
