<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Car Booking | Rent a Car</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Fallback Alpine if build fails - remove later if stable -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            [x-cloak] { display: none !important; }
        </style>
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Setting::get('favicon', 'favicon.ico')) }}">
    </head>
    <body class="antialiased bg-gray-50">
        
        <!-- Header Navigation Bar -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ profileOpen: false }">
            <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    @if($logo = \App\Models\Setting::get('logo'))
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-10 w-auto rounded-xl">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    @endif
                    <span class="text-xl font-bold text-gray-900">Car Booking</span>
                </a>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8">
                    @if(isset($headerMenu) && $headerMenu->items)
                        @foreach($headerMenu->items as $item)
                            <a href="{{ $item->url }}" 
                               class="{{ Request::is(trim($item->url, '/')) ? 'text-blue-600' : 'text-gray-600' }} font-semibold hover:text-blue-600 transition-colors">
                                {{ $item->label }}
                            </a>
                        @endforeach
                    @else
                        <a href="/" class="text-gray-900 font-semibold hover:text-blue-600 transition-colors">Home</a>
                        <a href="/about-us" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">About Us</a>
                        <a href="/services" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">Services</a>
                        <a href="/blogs" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">Blogs</a>
                        <a href="/contact" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">Contact</a>
                    @endif
                </div>

                <!-- User Profile / Auth -->
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">Admin Panel</a>
                        @else
                            <div class="relative flex items-center space-x-3">
                                <!-- Profile Button -->
                                <a href="{{ route('user.dashboard') }}?tab=profile" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                    Profile
                                </a>

                                <!-- Dropdown Toggle -->
                                <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 hover:bg-gray-50 rounded-lg px-3 py-2 transition-colors border border-gray-100">
                                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="profileOpen" @click.away="profileOpen = false" x-cloak x-transition
                                    class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-[60]">
                                    <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                        <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    </div>
                                    <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                        My Dashboard
                                    </a>
                                    <a href="{{ route('user.dashboard') }}?tab=bookings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                        My Trips
                                    </a>
                                    <hr class="my-2 border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section - Two Column Layout -->
        <section id="booking-form" class="py-12 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-[calc(100vh-4rem)]">
            <div class="max-w-7xl mx-auto px-6 h-full">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center h-full">
                    
                    <!-- Left Column: Booking Form -->
                    <div>
                        <div class="mb-8">
                            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">Book Your Ride</h1>
                            <p class="text-xl text-gray-600">Choose your trip type and get started</p>
                        </div>

                        <!-- Booking Panel -->
                        <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 p-8" 
                            x-data="{
                                tripType: 'roundtrip',
                                dropLocations: [1],
                                pickupLocation: '',
                                dropLocation1: '',
                                pickupDate: '',
                                pickupTime: '',
                                returnDate: '',
                                packageId: '', // Added packageId state
                                
                                addDropLocation() {
                                    this.dropLocations.push(this.dropLocations.length + 1);
                                },
                                
                                removeDropLocation(index) {
                                    if (this.dropLocations.length > 1) {
                                        this.dropLocations.splice(index, 1);
                                    }
                                },
                                
                                searchRide() {
                                    if (!this.pickupLocation) {
                                        alert('Please enter pickup location');
                                        return;
                                    }
                                    
                                    if (this.tripType !== 'local' && !this.dropLocation1) {
                                        alert('Please enter drop location');
                                        return;
                                    }
                                    
                                    if (this.tripType !== 'oneway' && (!this.pickupDate || !this.pickupTime)) {
                                        alert('Please select pickup date and time');
                                        return;
                                    }
                                    
                                    if (this.tripType === 'roundtrip' && !this.returnDate) {
                                        alert('Please select return date');
                                        return;
                                    }
                                    
                                    // alert('Searching for available rides...');
                                    
                                    // Construct query params
                                    let params = new URLSearchParams({
                                        trip_type: this.tripType,
                                        pickup_location: this.pickupLocation,
                                        pickup_date: this.pickupDate,
                                        pickup_time: this.pickupTime
                                    });

                                    if (this.tripType === 'roundtrip') {
                                        this.dropLocations.forEach((loc, index) => {
                                            if (index === 0) params.append('drop_location', this.dropLocation1);
                                            // Handle multiple drops if backend supports it later
                                        });
                                        params.append('return_date', this.returnDate);
                                    } else if (this.tripType === 'oneway' || this.tripType === 'airport') {
                                        params.append('drop_location', this.dropLocation1);
                                    } else if (this.tripType === 'local') {
                                        params.append('package_id', this.packageId);
                                    }
                                    
                                    window.location.href = '{{ route('user.booking.index') }}?' + params.toString();
                                }
                            }">
                            
                            <!-- Trip Type Tabs -->
                            <!-- ... existing tabs ... -->
                            
                            <!-- (Code omitted for brevity, focusing on Form Fields changes) -->
                            
                                <!-- RENTAL FORM -->
                                <div x-show="tripType === 'local'">
                                    <!-- City & Package Row -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                                        <div>
                                            <label for="city-rental" class="block text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">City</label>
                                            <input type="text" id="city-rental" name="city" x-model="pickupLocation" placeholder="Enter a City or Airport"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label for="package-rental" class="block text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">Rental Package</label>
                                            <select id="package-rental" x-model="packageId" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                                <option value="">Select Duration / Distance</option>
                                                @foreach($packages as $pkg)
                                                    <option value="{{ $pkg->id }}">{{ $pkg->name }} ({{ $pkg->days }} Days)</option>
                                                @endforeach
                                                <option value="custom">Custom (Hourly)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Pickup Date & Time -->
                                    <div class="grid grid-cols-2 gap-4 mb-5">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-900 mb-2">Pickup Date</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <input type="date" id="pickup-date-rental" name="pickup_date" x-model="pickupDate"
                                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-900 mb-2">Select Time</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <input type="time" id="pickup-time-rental" name="pickup_time" x-model="pickupTime"
                                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Button -->
                                <button @click="searchRide()" 
                                    class="w-full bg-black text-white py-4 rounded-lg font-bold text-base hover:bg-gray-800 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search
                                </button>

                            </div>

                        </div>
                    </div>

                    <!-- Right Column: Illustration -->
                    <div class="hidden lg:flex items-center justify-center">
                        <div class="relative w-full">
                            <!-- Professional Illustration: Girl with Luggage and Taxi -->
                            <img src="{{ asset('images/hero-illustration.png') }}" 
                                 alt="Woman with luggage standing next to a taxi cab" 
                                 class="w-full h-auto drop-shadow-2xl rounded-2xl"
                                 loading="lazy">
                            
                            <!-- Text Overlay -->
                            <div class="absolute -bottom-8 left-0 right-0 text-center">
                                <p class="text-2xl font-bold text-gray-800">Your Journey Starts Here</p>
                                <p class="text-gray-600 mt-2">Safe, Comfortable & Reliable</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        @include('partials.home_sections')

        <!-- Footer -->
        @include('partials.footer')

    </body>
</html>
