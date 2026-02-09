<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->sort ?? 'created_at';
        $order = $request->order ?? 'desc';
        $query->orderBy($sort, $order);

        $customers = $query->paginate($request->per_page ?? 10);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all();
        return view('admin.customers.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|size:10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'pincode' => 'required|string|max:10',
            'password' => 'required|confirmed|min:6',
        ]);

        $customerCode = '#' . rand(100000, 999999);
        while (Customer::where('customer_code', $customerCode)->exists()) {
            $customerCode = '#' . rand(100000, 999999);
        }

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('customer_profiles', 'public');
        }

        $validated['customer_code'] = $customerCode;
        $validated['password'] = Hash::make($request->password);

        Customer::create($validated);

        return redirect()->route('admin.customers.index')->with('success', 'Customer added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $states = State::all();
        $cities = City::where('state_id', $customer->state_id)->get();
        return view('admin.customers.edit', compact('customer', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|size:10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'pincode' => 'required|string|max:10',
            'password' => 'nullable|confirmed|min:6',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($customer->profile_image) {
                Storage:: disk('public')->delete($customer->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('customer_profiles', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $customer->update($validated);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->profile_image) {
            Storage::disk('public')->delete($customer->profile_image);
        }
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully');
    }

    /**
     * Get cities for a specific state via AJAX
     */
    public function getCities(State $state)
    {
        return response()->json($state->cities);
    }
}
