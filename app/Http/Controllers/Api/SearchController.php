<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Simple search echo for now
        return response()->json([
            'status' => 'success',
            'message' => 'Search initiated for ' . $request->input('tripType'),
            'data' => $request->all()
        ]);
    }
}
