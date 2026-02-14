<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('status', 'active')->firstOrFail();
        return view('frontend.service', compact('service'));
    }
}
