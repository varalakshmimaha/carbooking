<section class="py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="relative overflow-hidden bg-blue-600 rounded-[3rem] px-8 py-16 md:px-16 text-center shadow-2xl">
            
            <!-- Abstract background shapes -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-black/10 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>

            <div class="relative z-10 space-y-8 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-black text-white leading-tight">
                    {{ $data['title'] ?? 'Ready to Book Your Ride?' }}
                </h2>
                
                <p class="text-blue-100 text-lg md:text-xl font-medium">
                    {{ $data['subtitle'] ?? 'Compare prices, book instantly and travel with confidence.' }}
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-6">
                    <a href="tel:{{ $data['phone'] ?? '+1234567890' }}" class="group bg-white text-blue-600 px-10 py-5 rounded-[2rem] font-black shadow-xl hover:bg-gray-100 transition-all flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 15.5c-1.2 0-2.4-.2-3.6-.6-.3-.1-.7 0-1 .2l-2.2 2.2c-2.8-1.4-5.1-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1-.3-1.1-.5-2.3-.5-3.5 0-.8-.7-1.5-1.5-1.5H4c-.8 0-1.5.7-1.5 1.5 0 9.4 7.6 17 17 17 .8 0 1.5-.7 1.5-1.5v-3.5c0-.8-.7-1.5-1.5-1.5z"></path>
                            </svg>
                        </div>
                        {{ $data['phone'] ?? '+1234567890' }}
                    </a>
                    
                    <a href="/contact" class="px-10 py-5 bg-blue-800/30 backdrop-blur-md text-white border-2 border-white/20 rounded-[2rem] font-black hover:bg-white hover:text-blue-600 transition-all duration-300">
                        {{ $data['button_text'] ?? 'Contact Now' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
