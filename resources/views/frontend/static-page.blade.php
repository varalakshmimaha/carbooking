@extends('layouts.frontend')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? '')

@push('styles')
<style>
    .page-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-top: 2rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .page-content h2:first-child {
        margin-top: 0;
    }
    .page-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .page-content p {
        color: #4b5563;
        line-height: 1.75;
        margin-bottom: 1rem;
    }
    .page-content ul, .page-content ol {
        color: #4b5563;
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
    .page-content ul {
        list-style-type: disc;
    }
    .page-content ol {
        list-style-type: decimal;
    }
    .page-content li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
    .page-content a {
        color: #2563eb;
        text-decoration: none;
    }
    .page-content a:hover {
        text-decoration: underline;
    }
    .page-content strong {
        color: #111827;
        font-weight: 600;
    }
    .page-content em {
        color: #6b7280;
    }
    .page-content blockquote {
        border-left: 4px solid #3b82f6;
        background-color: #eff6ff;
        padding: 0.75rem 1rem;
        border-radius: 0 0.5rem 0.5rem 0;
        margin-bottom: 1rem;
    }
    .page-content br {
        content: "";
        display: block;
        margin-bottom: 0.25rem;
    }
</style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="/" class="text-gray-400 hover:text-white transition-colors">Home</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li>
                        <span class="text-gray-300">{{ $page->title }}</span>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $page->title }}</h1>
        </div>
    </section>

    <!-- Page Content -->
    <section class="py-12 md:py-16">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
                <div class="page-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
