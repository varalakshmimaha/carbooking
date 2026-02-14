@extends('layouts.frontend')

@section('title', $service->meta_title ?? $service->name)
@section('meta_description', $service->meta_description ?? $service->short_description)

@section('content')
<div class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-8">
            <a href="/" class="hover:text-indigo-600">Home</a>
            <span>/</span>
            <span class="text-gray-900">{{ $service->name }}</span>
        </div>

        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">{{ $service->name }}</h1>
        
        @if($service->featured_image)
            <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->name }}" class="w-full h-96 object-cover rounded-2xl mb-8 shadow-lg">
        @endif

        <div class="prose prose-lg max-w-none text-gray-600">
            {!! $service->full_description !!}
        </div>
        
        <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between">
            <a href="/" class="text-gray-600 font-semibold hover:text-indigo-600 transition-colors">
                &larr; Back to Home
            </a>
            <a href="{{ route('user.booking.index') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-all hover:scale-105">
                Book Now
            </a>
        </div>
    </div>
</div>
@endsection
