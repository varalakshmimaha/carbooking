<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-2xl space-y-4">
                <div class="inline-flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-full">
                    <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                    <span class="text-blue-700 text-sm font-bold tracking-wide uppercase">Featured Tours</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900">Most Popular Packages</h2>
                <p class="text-lg text-gray-500 leading-relaxed">Choose from our curated selection of travel packages designed for comfort and adventure.</p>
            </div>
            <a href="/packages" class="text-blue-600 font-bold flex items-center gap-2 hover:gap-3 transition-all">
                View All Packages
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($data as $package)
                <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full">
                    <!-- Image -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $package->image ? asset('storage/' . $package->image) : 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?q=80&w=1000' }}" 
                             alt="{{ $package->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute top-5 left-5">
                            <span class="bg-white/90 backdrop-blur-sm text-gray-900 px-4 py-2 rounded-2xl text-xs font-bold shadow-lg">
                                {{ $package->days ?? '1' }} Days
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8 flex flex-col flex-1">
                        <div class="flex items-center gap-2 text-blue-600 mb-3 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            {{ $package->destination ?? 'Popular Destination' }}
                        </div>
                        
                        <h3 class="text-xl font-extrabold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                            {{ $package->name }}
                        </h3>
                        
                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-50">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Starting From</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-2xl font-black text-gray-900">₹{{ number_format($package->amount) }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('user.booking.index', ['package_id' => $package->id]) }}" 
                               class="p-4 bg-gray-900 text-white rounded-2xl hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-200">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[2.5rem] border border-dashed border-gray-300">
                    <p class="text-gray-500 font-medium italic">No travel packages available at the moment.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</section>
