<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Set default display_order if not provided
        if (!isset($validated['display_order']) || $validated['display_order'] === null) {
            $validated['display_order'] = 0;
        }

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'display_order' => 'integer',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Ensure display_order is set (handle null case)
        if (!isset($validated['display_order']) || $validated['display_order'] === null) {
            $validated['display_order'] = 0;
        }

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
