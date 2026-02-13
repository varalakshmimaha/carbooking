@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<div class="relative h-[400px] w-full overflow-hidden">
    @if($post->banner_image)
        <img src="{{ asset('storage/' . $post->banner_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    @elseif($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    @else
        <div class="w-full h-full bg-gray-900"></div>
    @endif
    
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4 max-w-4xl">
            @if($post->category)
                <span class="bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wide mb-4 inline-block">
                    {{ $post->category->name }}
                </span>
            @endif
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">{{ $post->title }}</h1>
            <div class="flex items-center justify-center text-sm md:text-base opacity-90 space-x-6">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    {{ $post->created_at->format('F d, Y') }}
                </span>
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    {{ $post->author_name ?? 'Admin' }}
                </span>
                @if($post->views > 0)
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    {{ $post->views }} Views
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="hover:text-gray-900">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="{{ url('/blogs') }}" class="ml-1 hover:text-gray-900 md:ml-2">Blogs</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-gray-700 md:ml-2 font-medium truncate max-w-xs">{{ $post->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Content -->
    <article class="prose prose-lg max-w-none text-gray-800">
        {{-- If content is HTML, render it. If plain text, wrap in p --}}
        {!! $post->full_content !!}
    </article>

    <!-- Tags (if any) -->
    @if($post->tags && $post->tags->count() > 0)
    <div class="mt-8 pt-8 border-t border-gray-200">
        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-3">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm hover:bg-gray-200 cursor-pointer">#{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Share (Optional) -->
    
    <!-- Navigation to other posts (Optional) -->
    
</div>

@endsection
