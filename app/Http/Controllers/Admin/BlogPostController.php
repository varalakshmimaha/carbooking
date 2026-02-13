<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::query()->with('category');

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('date') && $request->date) {
            $query->whereDate('publish_date', $request->date);
        }

        $posts = $query->latest()->paginate(10);
        $categories = BlogCategory::all();

        return view('admin.blog.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::where('status', 'active')->get();
        $tags = BlogTag::all();
        return view('admin.blog.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug',
            'category_id' => 'required|exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'short_description' => 'required|string|max:255',
            'full_content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'estimated_reading_time' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('blog/banners', 'public');
        }

        $post = BlogPost::create($validated);

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.blog.posts.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::where('status', 'active')->get();
        $tags = BlogTag::all();
        $post->load('tags');
        return view('admin.blog.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug,' . $post->id,
            'category_id' => 'required|exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'short_description' => 'required|string|max:255',
            'full_content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'estimated_reading_time' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($post->banner_image) {
                Storage::disk('public')->delete($post->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('blog/banners', 'public');
        }

        $post->update($validated);

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.blog.posts.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        if ($post->banner_image) {
            Storage::disk('public')->delete($post->banner_image);
        }
        $post->delete();

        return redirect()->route('admin.blog.posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
