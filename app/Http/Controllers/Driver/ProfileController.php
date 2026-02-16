<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;

class ProfileController extends Controller
{
    public function edit()
    {
        $driver = Auth::guard('driver')->user();
        return view('driver.profile.edit', compact('driver'));
    }

    public function update(Request $request)
    {
        $driver = Auth::guard('driver')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('drivers')->ignore($driver->id)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('drivers')->ignore($driver->id)],
            // Add other fields as needed, e.g., license_number
            'current_password' => ['nullable', 'required_with:new_password', 'current_password:driver'],
            'new_password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $driver->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        if ($request->filled('new_password')) {
            $driver->password = Hash::make($validated['new_password']);
        }

        $driver->save();

        return redirect()->route('driver.profile.edit')->with('status', 'profile-updated');
    }
}
