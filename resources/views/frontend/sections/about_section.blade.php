<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            
            <!-- Image / Decorative Plate -->
            <div class="flex-1 relative" data-aos="fade-left">
                <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <img src="{{ $data['image'] ? asset('storage/' . $data['image']) : 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=1000' }}" 
                         alt="About Us" 
                         class="w-full h-full object-cover aspect-[4/3]">
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-pink-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
            </div>

            <!-- Content -->
            <div class="flex-1 space-y-8 pl-0 md:pl-10" data-aos="fade-right">
                <div class="space-y-4">
                    <span class="text-blue-600 font-bold tracking-widest uppercase text-sm">Who We Are</span>
                    
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                        {{ $data['title'] ?? 'About Our Company' }}
                    </h2>
                </div>
                
                <div class="text-lg text-gray-600 leading-relaxed font-light">
                    {!! nl2br(e($data['description'] ?? 'As a premier car booking service, we are dedicated to providing you with safe, reliable, and comfortable transportation. Our fleet of luxury and economy vehicles ensures a perfect ride for every occasion.')) !!}
                </div>
                
                <div class="grid grid-cols-2 gap-8 border-t border-gray-100 pt-8">
                    <div>
                        <h4 class="text-4xl font-extrabold text-gray-900">{{ $data['happy_customers'] ?? '5000+' }}</h4>
                        <p class="text-sm text-gray-500 font-medium mt-1">Happy Customers</p>
                    </div>
                    <div>
                        <h4 class="text-4xl font-extrabold text-gray-900">{{ $data['luxury_cars'] ?? '100+' }}</h4>
                        <p class="text-sm text-gray-500 font-medium mt-1">Luxury Cars</p>
                    </div>
                </div>
                
                <div class="pt-4">
                    <a href="/about-us" class="inline-flex items-center px-8 py-4 bg-black text-white font-bold rounded-lg hover:bg-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Learn More About Us
                        <svg class="w-5 h-5 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</section>
