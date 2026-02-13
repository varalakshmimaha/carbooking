<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\SectionType;
use App\Models\PageSection;

class PageBuilderController extends Controller
{
    public function show(Page $page)
    {
        $page->load(['sections.type']);
        $sectionTypes = SectionType::where('is_active', true)->get();
        return view('admin.pages.builder', compact('page', 'sectionTypes'));
    }

    public function addSection(Request $request, Page $page)
    {
        $validated = $request->validate([
            'section_type_key' => 'required|exists:section_types,key',
        ]);

        $sectionType = SectionType::where('key', $validated['section_type_key'])->first();
        
        $lastPosition = PageSection::where('page_id', $page->id)->max('position') ?? -1;

        PageSection::create([
            'page_id' => $page->id,
            'section_type_id' => $sectionType->id,
            'position' => $lastPosition + 1,
            'is_visible' => true,
            'settings' => $sectionType->default_settings,
        ]);

        return back()->with('success', 'Section added successfully.');
    }

    public function updateSection(Request $request, PageSection $section)
    {
        $validated = $request->validate([
            'is_visible' => 'sometimes|boolean',
            'settings' => 'sometimes|array',
        ]);

        if ($request->has('is_visible')) {
            $section->is_visible = $request->is_visible;
        }

        if ($request->has('settings')) {
            $section->settings = array_merge($section->settings ?? [], $request->settings);
        }

        $section->save();

        return response()->json(['success' => true]);
    }

    public function reorderSections(Request $request, Page $page)
    {
        $validated = $request->validate([
            'ordered_ids' => 'required|array',
            'ordered_ids.*' => 'exists:page_sections,id',
        ]);

        foreach ($validated['ordered_ids'] as $index => $id) {
            PageSection::where('id', $id)->where('page_id', $page->id)->update(['position' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function removeSection(PageSection $section)
    {
        $section->delete();
        return back()->with('success', 'Section removed successfully.');
    }

    public function getSection(PageSection $section)
    {
        return response()->json([
            'id' => $section->id,
            'type_key' => $section->type->key,
            'type_name' => $section->type->name,
            'settings' => $section->settings,
            'is_visible' => $section->is_visible,
        ]);
    }
}
