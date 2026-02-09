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

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        
        <!-- Header Navigation Bar -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ profileOpen: false }">
            <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Car Booking</span>
                </a>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-900 font-semibold hover:text-blue-600 transition-colors">Home</a>
                    <a href="#about" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">About Us</a>
                    <a href="#contact" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">Contact</a>
                    <a href="#services" class="text-gray-600 font-semibold hover:text-blue-600 transition-colors">Services</a>
                </div>

                <!-- User Profile / Auth -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- User Profile Dropdown -->
                        <div class="relative">
                            <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 hover:bg-gray-50 rounded-lg px-3 py-2 transition-colors">
                                <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="profileOpen" @click.away="profileOpen = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    My Profile
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    My Trips
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
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

        <!-- Hero Section - Booking Panel -->
        <section class="py-12 bg-gradient-to-b from-blue-50 to-white">
            <div class="max-w-7xl mx-auto px-6">
                
                <div class="text-center mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">Book Your Ride</h1>
                    <p class="text-xl text-gray-600">Choose your trip type and get started</p>
                </div>

                <!-- Booking Panel -->
                <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-200 p-8" 
                    x-data="{
                        tripType: 'roundtrip',
                        dropLocations: [1],
                        pickupLocation: '',
                        dropLocation1: '',
                        pickupDate: '',
                        pickupTime: '',
                        returnDate: '',
                        
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
                            
                            if (!this.dropLocation1) {
                                alert('Please enter drop location');
                                return;
                            }
                            
                            if (!this.pickupDate || !this.pickupTime) {
                                alert('Please select pickup date and time');
                                return;
                            }
                            
                            if (this.tripType === 'roundtrip' && !this.returnDate) {
                                alert('Please select return date');
                                return;
                            }
                            
                            alert('Searching for available rides...');
                        }
                    }">
                    
                    <!-- Trip Type Tabs -->
                    <div class="flex gap-3 mb-8">
                        <button @click="tripType = 'oneway'" 
                            :class="tripType === 'oneway' ? 'bg-black text-white' : 'bg-gray-200 text-gray-700'"
                            class="px-6 py-2.5 rounded-full font-semibold transition-all text-sm">
                            One Way
                        </button>
                        <button @click="tripType = 'roundtrip'" 
                            :class="tripType === 'roundtrip' ? 'bg-black text-white' : 'bg-gray-200 text-gray-700'"
                            class="px-6 py-2.5 rounded-full font-semibold transition-all text-sm">
                            Round Trip
                        </button>
                        <button @click="tripType = 'rental'" 
                            :class="tripType === 'rental' ? 'bg-black text-white' : 'bg-gray-200 text-gray-700'"
                            class="px-6 py-2.5 rounded-full font-semibold transition-all text-sm">
                            Rental
                        </button>
                        <button @click="tripType = 'airport'" 
                            :class="tripType === 'airport' ? 'bg-black text-white' : 'bg-gray-200 text-gray-700'"
                            class="px-6 py-2.5 rounded-full font-semibold transition-all text-sm">
                            Airport
                        </button>
                    </div>

                    <!-- Form Fields -->
                    <div class="space-y-5">
                        
                        <!-- ROUND TRIP FORM -->
                        <div x-show="tripType === 'roundtrip'">
                            <!-- Pickup Location -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Pickup Location</label>
                                <input type="text" x-model="pickupLocation" placeholder="Enter a location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Drop Off Locations -->
                            <template x-for="(loc, index) in dropLocations" :key="index">
                                <div class="mb-5">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-sm font-bold text-gray-900">
                                            Drop Off Location <span x-text="loc"></span>
                                        </label>
                                        <div class="flex gap-2">
                                            <button type="button" @click="addDropLocation()" 
                                                class="w-7 h-7 bg-black text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                            <button type="button" @click="removeDropLocation(index)" 
                                                x-show="dropLocations.length > 1"
                                                class="w-7 h-7 bg-black text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="text" x-model="dropLocation1" placeholder="Enter a location"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </template>

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
                                        <input type="date" x-model="pickupDate"
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
                                        <input type="time" x-model="pickupTime"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Return Date -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Return Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" x-model="returnDate"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- ONE WAY & AIRPORT FORM -->
                        <div x-show="tripType === 'oneway' || tripType === 'airport'">
                            <!-- Pickup Location -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Pickup Location</label>
                                <input type="text" x-model="pickupLocation" placeholder="Enter a location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Drop Off Location -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Drop Off Location</label>
                                <input type="text" x-model="dropLocation1" placeholder="Enter a location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                                        <input type="date" x-model="pickupDate" placeholder="dd-mm-yyyy"
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
                                        <input type="time" x-model="pickupTime" placeholder="--:--"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RENTAL FORM -->
                        <div x-show="tripType === 'rental'">
                            <!-- City -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">City</label>
                                <input type="text" x-model="pickupLocation" placeholder="Enter a City or Airport"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                                        <input type="date" x-model="pickupDate"
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
                                        <input type="time" x-model="pickupTime"
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
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8 mt-12">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} Car Booking. All rights reserved.</p>
            </div>
        </footer>

    </body>
</html>
