<!-- Hero Section - Two Column Layout -->
<section class="py-12 bg-gradient-to-br {{ $data['bg_gradient'] ?? 'from-blue-50 via-indigo-50 to-purple-50' }} min-h-[calc(100vh-4rem)]">
    <div class="max-w-7xl mx-auto px-6 h-full">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center h-full">
            
            <!-- Left Column: Booking Form -->
            <div>
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">{{ $data['title'] }}</h1>
                    <p class="text-xl text-gray-600">{{ $data['subtitle'] }}</p>
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
                        packageId: '',
                        
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
                            
                            
                            if (this.tripType !== 'rental' && !this.dropLocation1) {
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
                                });
                                params.append('return_date', this.returnDate);
                            } else if (this.tripType === 'oneway' || this.tripType === 'airport') {
                                params.append('drop_location', this.dropLocation1);
                            } else if (this.tripType === 'rental') {
                                params.append('package_id', this.packageId);
                            }
                            
                            window.location.href = '{{ route('user.booking.index') }}?' + params.toString();
                        }
                    }">
                    
                    <!-- Trip Type Tabs -->
                    <div class="flex gap-3 mb-8">
                        @foreach(['oneway' => 'One Way', 'roundtrip' => 'Round Trip', 'rental' => 'Rental', 'airport' => 'Airport'] as $type => $label)
                        <button @click="tripType = '{{ $type }}'" 
                            :class="tripType === '{{ $type }}' ? 'bg-black text-white' : 'bg-gray-200 text-gray-700'"
                            class="px-6 py-2.5 rounded-full font-semibold transition-all text-sm">
                            {{ $label }}
                        </button>
                        @endforeach
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
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                            </button>
                                            <button type="button" @click="removeDropLocation(index)" 
                                                x-show="dropLocations.length > 1"
                                                class="w-7 h-7 bg-black text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
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
                                    <input type="date" x-model="pickupDate"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-2">Select Time</label>
                                    <input type="time" x-model="pickupTime"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <!-- Return Date -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Return Date</label>
                                <input type="date" x-model="returnDate"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- ONE WAY & AIRPORT FORM -->
                        <div x-show="tripType === 'oneway' || tripType === 'airport'">
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Pickup Location</label>
                                <input type="text" x-model="pickupLocation" placeholder="Enter a location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-5">
                                <label class="block text-sm font-bold text-gray-900 mb-2">Drop Off Location</label>
                                <input type="text" x-model="dropLocation1" placeholder="Enter a location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <template x-if="tripType === 'airport'">
                                <div class="grid grid-cols-2 gap-4 mb-5">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-900 mb-2">Pickup Date</label>
                                        <input type="date" x-model="pickupDate"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-900 mb-2">Select Time</label>
                                        <input type="time" x-model="pickupTime"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- RENTAL FORM -->
                        <div x-show="tripType === 'rental'">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">City</label>
                                    <input type="text" name="city" x-model="pickupLocation" placeholder="Enter a City or Airport"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">Select Package</label>
                                    <select x-model="packageId" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                        <option value="">Select Duration / Distance</option>
                                        @if(isset($data['packages']))
                                            @foreach($data['packages'] as $pkg)
                                                <option value="{{ $pkg->id }}">{{ $pkg->name }} ({{ $pkg->days }} Days)</option>
                                            @endforeach
                                        @endif
                                        <option value="custom">Custom (Hourly)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-2">Pickup Date</label>
                                    <input type="date" x-model="pickupDate"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-2">Select Time</label>
                                    <input type="time" x-model="pickupTime"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <button @click="searchRide()" 
                            class="w-full bg-black text-white py-4 rounded-lg font-bold text-base hover:bg-gray-800 transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Illustration -->
            <div class="hidden lg:flex items-center justify-center">
                <div class="relative w-full">
                    <img src="{{ asset('images/hero-illustration.png') }}" alt="Hero Illustration" class="w-full h-auto drop-shadow-2xl rounded-2xl">
                    <div class="absolute -bottom-8 left-0 right-0 text-center">
                        <p class="text-2xl font-bold text-gray-800">Your Journey Starts Here</p>
                        <p class="text-gray-600 mt-2">Safe, Comfortable & Reliable</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
