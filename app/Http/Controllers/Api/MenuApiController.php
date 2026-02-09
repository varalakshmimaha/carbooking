<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuApiController extends Controller
{
    public function show($key)
    {
        $menu = Menu::where('key', $key)
            ->where('status', 'active')
            ->with(['items' => function($query) {
                $query->where('status', 'active')->with(['children' => function($q) {
                    $q->where('status', 'active');
                }]);
            }])
            ->first();

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        return response()->json([
            'menu' => [
                'name' => $menu->name,
                'key' => $menu->key,
                'display_rules' => [
                    'desktop' => $menu->show_on_desktop,
                    'mobile' => $menu->show_on_mobile,
                ]
            ],
            'items' => $menu->items
        ]);
    }
}
