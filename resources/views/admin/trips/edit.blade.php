<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 pb-12">
            
            <!-- Back Button -->
            <a href="{{ route('admin.trips.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Trips
            </a>

            <form action="{{ route('admin.trips.update', $booking) }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                    
                    <!-- Trip Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trip Type</label>
                        <select name="rental_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Trip Type</option>
                            <option value="One Way" {{ old('rental_type', $booking->rental_type) == 'One Way' ? 'selected' : '' }}>One Way</option>
                            <option value="Round Trip" {{ old('rental_type', $booking->rental_type) == 'Round Trip' ? 'selected' : '' }}>Round Trip</option>
                            <option value="Local / Hourly" {{ old('rental_type', $booking->rental_type) == 'Local / Hourly' ? 'selected' : '' }}>Local / Hourly</option>
                            <option value="Airport Pickup" {{ old('rental_type', $booking->rental_type) == 'Airport Pickup' ? 'selected' : '' }}>Airport Pickup</option>
                            <option value="Airport Drop" {{ old('rental_type', $booking->rental_type) == 'Airport Drop' ? 'selected' : '' }}>Airport Drop</option>
                        </select>
                    </div>

                    <!-- Customer Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                        <select name="customer_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $booking->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Trip Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trip Status</label>
                        <select name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Pending" {{ old('status', $booking->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ old('status', $booking->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Running" {{ old('status', $booking->status) == 'Running' ? 'selected' : '' }}>Running</option>
                            <option value="Completed" {{ old('status', $booking->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status', $booking->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Cab Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cab Type</label>
                        <select name="cab_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Cab Type</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type->name }}" {{ old('cab_type', $booking->cab_type) == $type->name ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Driver -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Driver</label>
                        <select name="driver_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Driver</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id', $booking->driver_id) == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <input type="number" name="amount" required step="0.01" min="0" value="{{ old('amount', $booking->amount) }}" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Pickup Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Location</label>
                        <input type="text" name="pickup_location" required value="{{ old('pickup_location', $booking->pickup_location) }}" placeholder="Enter a City or Airport" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Dropoff Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Location 
                            <span class="text-blue-600 text-xs font-semibold cursor-pointer hover:underline">Add | Remove</span>
                        </label>
                        <input type="text" name="drop_location" required value="{{ old('drop_location', $booking->drop_location) }}" placeholder="Enter a City or Airport" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="book_date" required value="{{ old('book_date', $booking->book_date->format('Y-m-d')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date', optional($booking->end_date)->format('Y-m-d')) }}" placeholder="--:--" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Verification Status -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Verification Status</label>
                        <div class="flex items-center space-x-8">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="verification_status" value="Verified" {{ old('verification_status', $booking->verification_status) == 'Verified' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Verified</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="verification_status" value="Not Verified" {{ old('verification_status', $booking->verification_status) == 'Not Verified' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-gray-700">Not Verified</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.trips.index') }}" class="px-8 py-3 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                        CANCEL
                    </a>
                    <button type="submit" class="px-8 py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600 transition-colors">
                        UPDATE
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
