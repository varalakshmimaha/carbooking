<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('display_order')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:services,slug',
            'short_description' => 'required|string|max:150',
            'full_description' => 'nullable|string',
            'icon_class' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Set default display_order if not provided
        if (!isset($validated['display_order']) || $validated['display_order'] === null) {
            $validated['display_order'] = 0;
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('services/banners', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:services,slug,' . $service->id,
            'short_description' => 'required|string|max:150',
            'full_description' => 'nullable|string',
            'icon_class' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Ensure display_order is set (handle null case)
        if (!isset($validated['display_order']) || $validated['display_order'] === null) {
            $validated['display_order'] = 0;
        }

        if ($request->hasFile('featured_image')) {
            if ($service->featured_image) {
                Storage::disk('public')->delete($service->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($service->banner_image) {
                Storage::disk('public')->delete($service->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('services/banners', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->featured_image) {
            Storage::disk('public')->delete($service->featured_image);
        }
        if ($service->banner_image) {
            Storage::disk('public')->delete($service->banner_image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
