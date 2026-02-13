<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment views
        $post->increment('views');

        return view('frontend.blog.show', compact('post'));
    }
}
