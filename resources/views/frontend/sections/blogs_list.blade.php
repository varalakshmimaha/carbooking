<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $data['title'] }}</h2>
            <p class="text-lg text-gray-600">{{ $data['subtitle'] }}</p>
        </div>

        @if($data['posts']->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($data['posts'] as $post)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                <!-- Image -->
                <div class="relative h-56 overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            {{ optional($post->category)->name ?? 'Blog' }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center text-sm text-gray-500 mb-3 space-x-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            {{ $post->author_name ?? 'Admin' }}
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h3>

                    <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                        {{ $post->short_description }}
                    </p>

                    <div class="pt-4 border-t border-gray-100 mt-auto">
                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center font-semibold text-blue-600 hover:text-blue-700 transition-colors group">
                            Read Full Article
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No Content Available</h3>
            <p class="text-gray-500">We are working on creating amazing content for you. Check back soon!</p>
        </div>
        @endif
    </div>
</section>
