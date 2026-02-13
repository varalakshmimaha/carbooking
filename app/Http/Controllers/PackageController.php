<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = \App\Models\Package::where('status', 'active')->get();
        return view('frontend.packages.index', compact('packages'));
    }
}
