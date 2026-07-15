<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::active()->ordered()->get();
        return view('pages.certificates.index', compact('certificates'));
    }
}
