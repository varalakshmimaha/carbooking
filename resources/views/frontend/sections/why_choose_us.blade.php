<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4">{{ $data['title'] }}</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-orange-400 to-yellow-400 mx-auto rounded-full mb-6"></div> <!-- Decorative line -->
            <p class="text-gray-500 max-w-2xl mx-auto">{{ $data['subtitle'] }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($data['features'] as $feature)
                <a href="{{ $feature->redirect_url ?? 'javascript:void(0)' }}" class="block relative group rounded-3xl p-8 {{ $feature->is_highlighted ? 'bg-black text-white' : 'bg-white text-gray-900 shadow-xl border border-gray-100' }} transition-transform duration-300 hover:-translate-y-2 text-center {{ $feature->redirect_url ? 'cursor-pointer' : 'cursor-default' }}">
                    
                    <!-- Icon Box -->
                    <div class="w-16 h-16 mx-auto -mt-12 mb-6 rounded-2xl flex items-center justify-center text-3xl shadow-lg {{ $feature->is_highlighted ? 'bg-white text-black' : 'bg-gray-900 text-white' }}">
                        @if($feature->icon_class)
                            <i class="{{ $feature->icon_class }}"></i>
                        @else
                            <i class="fa-solid fa-star"></i>
                        @endif
                    </div>

                    <h3 class="text-xl font-bold mb-4 {{ $feature->is_highlighted ? 'text-white' : 'text-gray-900' }}">{{ $feature->title }}</h3>
                    <p class="leading-relaxed {{ $feature->is_highlighted ? 'text-gray-300' : 'text-gray-500' }}">
                        {{ $feature->description }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>
