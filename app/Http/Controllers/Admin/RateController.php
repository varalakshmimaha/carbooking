<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rates = Rate::with('vehicleType')->latest()->paginate(10);
        return view('admin.rates.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleTypes = VehicleType::all();
        return view('admin.rates.create', compact('vehicleTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'default_rate' => 'required|numeric',
            'round_trip_rate' => 'nullable|numeric',
            'local_12_hours_rate' => 'nullable|numeric',
            'local_8_hours_rate' => 'nullable|numeric',
            'extra_km_charge' => 'nullable|numeric',
            'daily_max_km' => 'nullable|integer',
            'night_driving_charge' => 'nullable|numeric',
            'driver_allowance' => 'nullable|numeric',
            'gear_type' => 'required|string',
            'fuel_type' => 'required|string',
            'steering' => 'required|string',
            'capacity' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'terms_and_conditions' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rates', 'public');
        }

        Rate::create($validated);

        return redirect()->route('admin.rates.index')->with('success', 'Rate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rate $rate)
    {
        return view('admin.rates.show', compact('rate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate)
    {
        $vehicleTypes = VehicleType::all();
        return view('admin.rates.edit', compact('rate', 'vehicleTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $rate)
    {
        $validated = $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'default_rate' => 'required|numeric',
            'round_trip_rate' => 'nullable|numeric',
            'local_12_hours_rate' => 'nullable|numeric',
            'local_8_hours_rate' => 'nullable|numeric',
            'extra_km_charge' => 'nullable|numeric',
            'daily_max_km' => 'nullable|integer',
            'night_driving_charge' => 'nullable|numeric',
            'driver_allowance' => 'nullable|numeric',
            'gear_type' => 'required|string',
            'fuel_type' => 'required|string',
            'steering' => 'required|string',
            'capacity' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'terms_and_conditions' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            if ($rate->image) {
                Storage::disk('public')->delete($rate->image);
            }
            $validated['image'] = $request->file('image')->store('rates', 'public');
        }

        $rate->update($validated);

        return redirect()->route('admin.rates.index')->with('success', 'Rate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        if ($rate->image) {
            Storage::disk('public')->delete($rate->image);
        }
        $rate->delete();
        return back()->with('success', 'Rate deleted successfully.');
    }
}
