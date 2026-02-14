<section id="services" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ $settings['title'] ?? 'Our Premium Services' }}</h2>
            <div class="w-20 h-1.5 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-{{ $settings['columns'] ?? 3 }} gap-8">
            @foreach($data as $service)
                <div class="p-8 bg-gray-50 rounded-3xl border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        @if($service->icon_class)
                            <i class="{{ $service->icon_class }} text-2xl"></i>
                        @elseif($service->image)
                             <img src="{{ Storage::url($service->image) }}" alt="" class="w-8 h-8 object-contain">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ $service->short_description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
