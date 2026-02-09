<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::withCount('allItems')->orderBy('sort_order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'key' => 'required|unique:menus,key',
        ]);

        Menu::create($request->all());

        return redirect()->back()->with('success', 'Menu created successfully');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'key' => 'required|unique:menus,key,' . $menu->id,
        ]);

        $menu->update($request->all());

        return redirect()->back()->with('success', 'Menu updated successfully');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->back()->with('success', 'Menu deleted successfully');
    }
}
