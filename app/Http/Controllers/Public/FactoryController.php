<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class FactoryController extends Controller
{
    public function index()
    {
        return view('pages.factory.index');
    }
}
