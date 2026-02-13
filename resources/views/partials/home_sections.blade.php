
        <!-- About Us Section -->
        @if(isset($aboutPage) && $aboutPage)
        <section id="about" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-24 h-24 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <!-- Placeholder image or fetch from page meta if available -->
                            <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="{{ $aboutPage->title }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                    <div>
                        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">About Us</span>
                        <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-6">{{ $aboutPage->title }}</h2>
                        <div class="prose prose-lg text-gray-600 mb-8">
                            {!! Str::limit(strip_tags($aboutPage->content), 300) !!}
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <a href="{{ route('pages.frontend.show', $aboutPage->slug) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg hover:shadow-xl">
                                Read More
                            </a>
                            <a href="#contact" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Services Section -->
        @if(isset($servicesPage) && $servicesPage)
        <section id="services" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 max-w-3xl mx-auto">
                    <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Our Services</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">{{ $servicesPage->title }}</h2>
                    <p class="text-xl text-gray-600">Experience premium travel solutions tailored to your needs.</p>
                </div>
                
                @if($servicesPage->sections->count() > 0)
                     <div class="space-y-12">
                        @foreach($servicesPage->sections as $section)
                            @if($section->is_visible)
                                @php
                                    $resolverClass = 'App\\PageBuilder\\Resolvers\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $section->type->key))) . 'Resolver';
                                    $data = class_exists($resolverClass) ? (new $resolverClass)->resolve($section->settings ?? []) : [];
                                @endphp
                                @includeIf('frontend.sections.' . $section->type->key, ['settings' => $section->settings, 'data' => $data])
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 prose max-w-none">
                        {!! $servicesPage->content !!}
                    </div>
                @endif
            </div>
        </section>
        @endif
