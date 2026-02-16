<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Package::query();

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by Name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $packages = $query->latest()->paginate(10);
        $totalPackages = Package::count();
        $allNames = Package::select('name')->distinct()->get();

        return view('admin.packages.index', compact('packages', 'totalPackages', 'allNames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:packages,name|max:255',
            'description' => 'required|string',
            'type' => 'required|in:rental,airport',
            'amount' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Package added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:packages,name,' . $package->id,
            'description' => 'required|string',
            'type' => 'required|in:rental,airport',
            'amount' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully');
    }

    /**
     * Toggle status via AJAX or simple link
     */
    public function toggleStatus(Package $package)
    {
        $package->status = $package->status === 'active' ? 'inactive' : 'active';
        $package->save();

        return redirect()->back()->with('success', 'Package status updated');
    }
}
