<!-- Banner Section -->
<div class="bg-gray-900 text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center text-sm font-medium text-gray-400 mb-4">
            <a href="/" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3 h-3 mx-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-indigo-400">Contact</span>
        </div>
        <h1 class="text-4xl lg:text-5xl font-bold text-white">Contact Us</h1>
    </div>
</div>

<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">
            
            <!-- Left Side: Contact Form -->
            <div class="w-full order-2 lg:order-1">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 p-8 md:p-12 border border-gray-100 relative">
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-900 ml-1">Your name</label>
                                <input type="text" name="name" 
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-gray-400 font-medium" 
                                    placeholder="Enter your name">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-900 ml-1">Email address</label>
                                <input type="email" name="email" 
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-gray-400 font-medium" 
                                    placeholder="Enter your email">
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-900 ml-1">Contents</label>
                            <input type="text" name="subject" 
                                class="w-full bg-gray-50 border-gray-200 rounded-xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all placeholder-gray-400 font-medium" 
                                placeholder="Enter subject">
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-900 ml-1">Your message</label>
                            <textarea name="message" rows="5" 
                                class="w-full bg-gray-50 border-gray-200 rounded-xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none placeholder-gray-400 font-medium" 
                                placeholder="How can we help you?"></textarea>
                        </div>
                        
                        <button type="submit" 
                            class="w-full sm:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                            <span>Send message</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Stay Connected Info -->
            <div class="w-full flex flex-col justify-center space-y-10 order-1 lg:order-2">
                <div class="space-y-3">
                    <h2 class="text-3xl lg:text-4xl font-black text-gray-900 tracking-tight">
                        {{ $data['title'] ?? 'Stay connected' }}
                    </h2>
                    <p class="text-gray-500 text-lg leading-relaxed max-w-md">
                        {{ $data['subtitle'] ?? 'We are here to help.' }}
                    </p>
                </div>

                <div class="space-y-8">
                    <!-- Address -->
                    <div class="flex items-start gap-5 group">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-md transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-gray-900 mb-1">Address</h4>
                            <p class="text-gray-600 leading-relaxed text-sm">
                                {{ $data['address'] ?? 'Near Taluk Office, Main Road, Narasimharajpur - 577134' }}
                            </p>
                        </div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="flex items-start gap-5 group">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-md transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-gray-900 mb-1">Mobile Number</h4>
                            <p class="text-gray-900 font-medium text-lg">
                                {{ $data['phone'] ?? '9342361210' }}
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-5 group">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-md transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-gray-900 mb-1">Email</h4>
                            <p class="text-gray-600 font-medium text-sm">
                                {{ $data['email'] ?? 'raitha.okkuta@gmail.com' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
