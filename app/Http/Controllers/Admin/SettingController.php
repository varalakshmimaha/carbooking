<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = Setting::all()->groupBy('group')->mapWithKeys(function ($item, $key) {
            return [$key => $item->pluck('value', 'key')];
        });

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $group = $request->input('group', 'system');
        $inputs = $request->except(['_token', 'group', 'logo', 'favicon', 'admin_logo']);

        // Handle File Uploads for Logo Settings
        if ($group === 'logo') {
            $this->handleLogoUploads($request);
        }

        // Handle Password Change
        if ($group === 'password') {
            return $this->changePassword($request);
        }

        // Save generic settings
        foreach ($inputs as $key => $value) {
            Setting::set($key, $value, $group);
        }

        return back()->with('success', ucfirst($group) . ' settings updated successfully.');
    }

    /**
     * Handle Logo Uploads.
     */
    protected function handleLogoUploads(Request $request)
    {
        $files = ['logo', 'favicon', 'admin_logo'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $path = $request->file($file)->store('site', 'public');
                Setting::set($file, $path, 'logo');
            }
        }
    }

    /**
     * Handle Password Change.
     */
    protected function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
