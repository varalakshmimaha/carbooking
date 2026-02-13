<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight mb-4">
                {{ $data['title'] }}
            </h2>
            <p class="text-gray-500 text-lg">
                {{ $data['subtitle'] }}
            </p>
        </div>

        @if(count($data['testimonials']) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($data['testimonials'] as $testimonial)
                    <div class="bg-gray-50 rounded-2xl p-8 transition-transform hover:-translate-y-1 hover:shadow-lg border border-gray-100">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>

                        <p class="text-gray-700 leading-relaxed mb-6">
                            "{{ $testimonial->message }}"
                        </p>

                        <div class="flex items-center gap-4">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover bg-gray-200">
                            @else
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $testimonial->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $testimonial->designation ?? 'Customer' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <p class="text-gray-500 font-medium">No testimonials found yet.</p>
            </div>
        @endif

    </div>
</section>
