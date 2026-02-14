<footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Top Row: 4 Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-gray-700/50">

            <!-- Column 1: Logo & Description -->
            <div>
                <a href="/" class="flex items-center space-x-2 mb-5">
                    @php $logo = \App\Models\Setting::get('logo'); @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-10 w-auto rounded-xl bg-white p-1">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    @endif
                    <span class="text-xl font-bold text-white">Car Booking</span>
                </a>
                <p class="text-sm text-gray-400 leading-relaxed mb-5">
                    Your trusted ride partner for safe, comfortable, and reliable journeys. Book cabs for one-way trips, round trips, rentals, and airport transfers with ease.
                </p>
            </div>

            <!-- Column 2: Quick Links (Dynamic from Menu) -->
            <div>
                <h4 class="text-white font-bold text-base mb-5 relative">
                    {{ isset($footerCol1) ? $footerCol1->name : 'Quick Links' }}
                    <span class="block w-8 h-0.5 bg-blue-500 mt-2 rounded-full"></span>
                </h4>
                <ul class="space-y-3">
                    @if(isset($footerCol1) && $footerCol1->items->count())
                        @foreach($footerCol1->items as $item)
                            <li>
                                <a href="{{ $item->url }}" 
                                    class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"
                                    @if($item->target_blank) target="_blank" rel="noopener" @endif>
                                    <svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    {{ $item->label }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="/" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Home</a></li>
                        <li><a href="/about-us" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>About Us</a></li>
                        <li><a href="/services" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Services</a></li>
                        <li><a href="/contact" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Contact</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 3: Legal Policies (Dynamic from Menu) -->
            <div>
                <h4 class="text-white font-bold text-base mb-5 relative">
                    {{ isset($footerCol2) ? $footerCol2->name : 'Legal Policies' }}
                    <span class="block w-8 h-0.5 bg-blue-500 mt-2 rounded-full"></span>
                </h4>
                <ul class="space-y-3">
                    @if(isset($footerCol2) && $footerCol2->items->count())
                        @foreach($footerCol2->items as $item)
                            <li>
                                <a href="{{ $item->url }}" 
                                    class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"
                                    @if($item->target_blank) target="_blank" rel="noopener" @endif>
                                    <svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    {{ $item->label }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="/privacy-policy" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Privacy Policy</a></li>
                        <li><a href="/terms-conditions" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Terms & Conditions</a></li>
                        <li><a href="/refund-policy" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Refund Policy</a></li>
                        <li><a href="/cancellation-policy" class="text-sm text-gray-400 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2"><svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>Cancellation Policy</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4: Contact (Dynamic from Menu or Static Fallback) -->
            <div>
                <h4 class="text-white font-bold text-base mb-5 relative">
                    {{ isset($footerCol3) ? $footerCol3->name : 'Contact Us' }}
                    <span class="block w-8 h-0.5 bg-blue-500 mt-2 rounded-full"></span>
                </h4>
                @if(isset($footerCol3) && $footerCol3->items->count())
                    <ul class="space-y-3">
                        @foreach($footerCol3->items as $item)
                            <li>
                                <a href="{{ $item->url }}" 
                                    class="text-sm text-gray-400 hover:text-white transition-colors flex items-center gap-2"
                                    @if($item->target_blank) target="_blank" rel="noopener" @endif>
                                    @if($item->icon == 'map-pin')
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    @elseif($item->icon == 'phone')
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    @elseif($item->icon == 'mail')
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    @else
                                    <svg class="w-3 h-3 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    @endif
                                    <span class="text-sm text-gray-400 {{ in_array($item->icon, ['map-pin', 'phone', 'mail']) ? '' : 'hover:text-white hover:pl-1 transition-all duration-200' }}">
                                        {{ $item->label }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm text-gray-400">{{ \App\Models\Setting::get('company_address', 'Near Taluk Office, Main Road, Narasimharajpur - 577134') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-sm text-gray-400">{{ \App\Models\Setting::get('company_phone', '+91 9342361210') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm text-gray-400">{{ \App\Models\Setting::get('company_email', 'raitha.okkuta@gmail.com') }}</span>
                        </li>
                        </ul>
                @endif
                <!-- Social Icons -->
                <div class="flex space-x-3 mt-5">
                    @if($facebook = \App\Models\Setting::get('social_facebook', '#'))
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($instagram = \App\Models\Setting::get('social_instagram', '#'))
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-gray-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    @endif
                    @if($twitter = \App\Models\Setting::get('social_twitter', '#'))
                        <a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-gray-800 hover:bg-sky-500 rounded-lg flex items-center justify-center transition-colors" aria-label="Twitter">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    @endif
                    @if($whatsapp = \App\Models\Setting::get('social_whatsapp', '#'))
                        <a href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-gray-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-colors" aria-label="WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    @endif
                </div>

            </div>

        </div>

        <!-- Copyright Bar with Payment Icons -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Payment Method Icons (Left Side) - Hidden for now -->
            <div class="hidden flex items-center gap-4">
                <!-- Google Pay -->
                <div class="flex items-center gap-1.5 opacity-80 hover:opacity-100 transition-opacity" title="Google Pay">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                        <path d="M12.24 10.285V14.4h5.89c-.24 1.577-1.862 4.623-5.89 4.623-3.543 0-6.437-2.933-6.437-6.546s2.894-6.546 6.437-6.546c2.019 0 3.37.858 4.142 1.6l2.82-2.715C17.24 3.02 14.997 2 12.24 2 6.479 2 1.8 6.612 1.8 12.477c0 5.864 4.679 10.477 10.44 10.477 6.026 0 10.024-4.235 10.024-10.2 0-.685-.075-1.21-.163-1.73H12.24v-.739z" fill="white"/>
                    </svg>
                    <span class="text-xs font-medium text-gray-400">GPay</span>
                </div>

                <!-- PhonePe -->
                <div class="flex items-center gap-1.5 opacity-80 hover:opacity-100 transition-opacity" title="PhonePe">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                        <path d="M7 6h3.5l4 6.5V6H17v12h-2.5l-5-8v8H7V6z" fill="white"/>
                    </svg>
                    <span class="text-xs font-medium text-gray-400">PhonePe</span>
                </div>

                <!-- Paytm -->
                <div class="flex items-center gap-1.5 opacity-80 hover:opacity-100 transition-opacity" title="Paytm">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                        <rect x="2" y="6" width="20" height="12" rx="2" fill="none" stroke="white" stroke-width="1.5"/>
                        <path d="M6 10h3v1.5H7.5V13H6v-3zm4 0h3c.55 0 1 .45 1 1v.5c0 .55-.45 1-1 1h-2V13h-1v-3zm1 1.5h1.5v-.5H11v.5zM15 10h3v1h-2v.5h2v1.5h-3v-1h2v-.5h-2V10z" fill="white"/>
                    </svg>
                    <span class="text-xs font-medium text-gray-400">Paytm</span>
                </div>

                <!-- Razorpay -->
                <div class="flex items-center gap-1.5 opacity-80 hover:opacity-100 transition-opacity" title="Razorpay">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                        <path d="M8.5 3L3 21h4.5l2-6.5h5L16 21h4.5L14.5 3H8.5zm1.5 8.5L12 5l2 6.5h-4z" fill="white"/>
                    </svg>
                    <span class="text-xs font-medium text-gray-400">Razorpay</span>
                </div>

                <!-- Cash on Delivery -->
                <div class="flex items-center gap-1.5 opacity-80 hover:opacity-100 transition-opacity" title="Cash on Delivery">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                        <rect x="2" y="4" width="20" height="16" rx="2" fill="none" stroke="white" stroke-width="1.5"/>
                        <circle cx="12" cy="12" r="3" fill="none" stroke="white" stroke-width="1.5"/>
                        <path d="M6 8v-1m12 1v-1M6 17v-1m12 1v-1" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <span class="text-xs font-medium text-gray-400">Cash</span>
                </div>
            </div>

            <!-- Copyright (Right Side) -->
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Car Booking. All rights reserved.</p>
        </div>

    </div>
</footer>
