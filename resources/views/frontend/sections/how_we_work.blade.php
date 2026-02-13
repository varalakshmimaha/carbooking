<section class="py-24 bg-white relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
        <div class="absolute top-10 left-10 w-64 h-64 bg-blue-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-purple-500 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
            <div class="inline-flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-full mb-4">
                <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                <span class="text-blue-700 text-sm font-bold tracking-wide uppercase">Simple Process</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">
                {{ $data['title'] ?? 'How it Works' }}
            </h2>
            <p class="text-lg text-gray-500 font-medium">
                {{ $data['subtitle'] ?? 'Our simple 3-step process ensures a hassle-free booking experience for you.' }}
            </p>
        </div>

        <!-- Steps Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
            <!-- Connecting Line (Desktop) -->
            <div class="hidden md:block absolute top-24 left-[15%] right-[15%] h-0.5 bg-dashed bg-gradient-to-r from-blue-200 via-purple-200 to-blue-200 opacity-50"></div>

            @foreach($data['steps'] as $index => $step)
                <div class="relative flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- Step Number & Icon -->
                    <div class="relative mb-8 text-center flex flex-col items-center justify-center">
                        <!-- Background Circle -->
                        <div class="w-24 h-24 bg-white border-2 border-dashed border-blue-200 rounded-[2.5rem] flex items-center justify-center group-hover:border-blue-500 group-hover:rotate-6 transition-all duration-500 shadow-sm group-hover:shadow-xl group-hover:shadow-blue-100">
                             @if($index == 0)
                                <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                             @elseif($index == 1)
                                <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                             @else
                                <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                             @endif
                        </div>
                        <!-- Step Label -->
                        <div class="absolute -top-3 -right-3 w-10 h-10 bg-gray-900 text-white rounded-2xl flex items-center justify-center text-sm font-black shadow-lg">
                            0{{ $index + 1 }}
                        </div>
                    </div>

                    <!-- Content -->
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                        {{ $step['title'] }}
                    </h3>
                    <p class="text-gray-500 leading-relaxed max-w-[250px]">
                        {{ $step['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
