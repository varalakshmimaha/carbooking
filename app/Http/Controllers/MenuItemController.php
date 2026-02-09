<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Menu $menu)
    {
        $items = $menu->items()->with('children')->get();
        $all_items = $menu->allItems;
        return view('admin.menus.items', compact('menu', 'items', 'all_items'));
    }

    public function store(Request $request, Menu $menu)
    {
        $request->validate([
            'label' => 'required',
            'type' => 'required',
        ]);

        $menu->allItems()->create($request->all());

        return redirect()->back()->with('success', 'Menu item added successfully');
    }

    public function update(Request $request, MenuItem $item)
    {
        $request->validate([
            'label' => 'required',
            'type' => 'required',
        ]);

        $item->update($request->all());

        return redirect()->back()->with('success', 'Menu item updated successfully');
    }

    public function destroy(MenuItem $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Menu item deleted successfully');
    }
}
