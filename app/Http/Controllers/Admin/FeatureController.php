<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::orderBy('display_order')->get();
        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon_class' => 'nullable|string',
            'description' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            // Checkbox handling usually returns '1', 'on' or null. Better handle manually.
            'display_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['is_highlighted'] = $request->has('is_highlighted');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        Feature::create($validated);

        return redirect()->route('admin.features.index')->with('success', 'Feature created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon_class' => 'nullable|string',
            'description' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            'display_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['is_highlighted'] = $request->has('is_highlighted');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $feature->update($validated);

        return redirect()->route('admin.features.index')->with('success', 'Feature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.features.index')->with('success', 'Feature deleted successfully.');
    }
}
