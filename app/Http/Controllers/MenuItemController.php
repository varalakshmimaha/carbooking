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

        // Auto-assign next sort_order
        $maxOrder = $menu->allItems()->max('sort_order') ?? -1;
        $data = $request->all();
        $data['sort_order'] = $maxOrder + 1;

        $menu->allItems()->create($data);

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

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->items as $item) {
            MenuItem::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Menu items reordered successfully']);
    }
}
