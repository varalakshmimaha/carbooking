<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $query = Route::with(['fromCity', 'toCity']);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $routes = $query->latest()->paginate(10);
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('admin.routes.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:routes,slug',
            'image_title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('routes', 'public');
        }

        Route::create($validated);

        return redirect()->route('admin.routes.index')->with('success', 'Route created successfully.');
    }

    public function edit(Route $route)
    {
        $cities = City::orderBy('name')->get();
        return view('admin.routes.edit', compact('route', 'cities'));
    }

    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:routes,slug,' . $route->id,
            'image_title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($route->image) {
                Storage::disk('public')->delete($route->image);
            }
            $validated['image'] = $request->file('image')->store('routes', 'public');
        }

        $route->update($validated);

        return redirect()->route('admin.routes.index')->with('success', 'Route updated successfully.');
    }

    public function destroy(Route $route)
    {
        if ($route->image) {
            Storage::disk('public')->delete($route->image);
        }
        $route->delete();
        return back()->with('success', 'Route deleted successfully.');
    }

    /**
     * AI Content Generator (Simulated)
     */
    public function generateContent(Request $request)
    {
        $fromCity = City::find($request->from_city_id);
        $toCity = City::find($request->to_city_id);

        if (!$fromCity || !$toCity) {
            return response()->json(['error' => 'Select both cities first.'], 422);
        }

        $from = $fromCity->name;
        $to = $toCity->name;

        $title = "$from to $to Cab Service";
        $slug = Str::slug("$from to $to cab service");
        $imageTitle = "$from to $to Taxi Service";
        
        $description = "Travel comfortably from $from to $to with our reliable and professional cab service. We offer well-maintained vehicles and experienced drivers to ensure a smooth and safe journey. Choose from a wide range of cab options including hatchbacks, sedans, SUVs, and tempo travellers to suit your travel needs.\n\nOur $from to $to route is ideal for family trips, business travel, sightseeing, and weekend getaways. We provide flexible booking options such as one-way trips, round trips, and rentals with transparent pricing and no hidden charges. Enjoy timely pickups, clean vehicles, and courteous drivers who prioritize customer comfort.\n\nBook your $from to $to cab with confidence and experience a hassle-free journey with dependable service and excellent travel support.";

        return response()->json([
            'title' => $title,
            'slug' => $slug,
            'image_title' => $imageTitle,
            'description' => $description
        ]);
    }
}
