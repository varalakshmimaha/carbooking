<section class="relative bg-gray-900 overflow-hidden">
    <!-- Very simple slider mockup -->
    <div class="flex">
        @foreach($data as $item)
            <div class="relative w-full flex-shrink-0 h-[500px] flex items-center justify-center">
                <img src="{{ $item['image'] }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
                <div class="relative z-10 text-center px-6">
                    <h1 class="text-5xl font-extrabold text-white mb-4 animate-in slide-in-from-bottom duration-700">{{ $item['title'] }}</h1>
                    <button class="px-8 py-3 bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-700 transition transform hover:scale-105">Book Now</button>
                </div>
            </div>
            @break <!-- Just show one for now in mockup -->
        @endforeach
    </div>
</section>
