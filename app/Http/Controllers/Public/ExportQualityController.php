<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class ExportQualityController extends Controller
{
    public function index()
    {
        return view('pages.export-quality.index');
    }
}
