@extends('layouts.frontend')

@section('title', 'My Dashboard - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 py-10" 
    x-data="{ 
        activeTab: '{{ request('tab', 'profile') }}',
        showTourModal: false, 
        selectedTour: {},
        formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
        },
        openTourModal(tour) {
            this.selectedTour = tour;
            this.showTourModal = true;
        }
    }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Dashboard</h1>
                <p class="text-gray-500 mt-1">Manage your account and view your bookings</p>
            </div>
            <a href="{{ url('/#booking-form') }}" class="hidden sm:inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Book New Ride
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Left Sidebar (Tabs) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-6 bg-gray-50 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <nav class="p-2 space-y-1">
                        <button @click="activeTab = 'profile'" 
                            :class="{'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600': activeTab === 'profile', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'profile'}"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium transition-colors duration-150">
                            <svg class="mr-3 h-5 w-5" :class="activeTab === 'profile' ? 'text-indigo-500' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </button>

                        <button @click="activeTab = 'password'" 
                            :class="{'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600': activeTab === 'password', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'password'}"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium transition-colors duration-150">
                            <svg class="mr-3 h-5 w-5" :class="activeTab === 'password' ? 'text-indigo-500' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Change Password
                        </button>

                        <button @click="activeTab = 'bookings'" 
                            :class="{'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600': activeTab === 'bookings', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'bookings'}"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium transition-colors duration-150">
                            <svg class="mr-3 h-5 w-5" :class="activeTab === 'bookings' ? 'text-indigo-500' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            My Bookings
                        </button>
                        
                        {{-- <button @click="activeTab = 'tours'" 
                            :class="{'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600': activeTab === 'tours', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'tours'}"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium transition-colors duration-150">
                            <svg class="mr-3 h-5 w-5" :class="activeTab === 'tours' ? 'text-indigo-500' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            My Tours
                        </button> --}}

                        <hr class="my-2 border-gray-100">
                        
                        <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors duration-150 rounded-lg">
                                <svg class="mr-3 h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="lg:col-span-3">
                
                <!-- Tab: Profile -->
                <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Profile Information</h2>
                    
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Member Since</label>
                                <input type="text" value="{{ $user->created_at->format('d M Y') }}" readonly class="w-full rounded-lg border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 transition-all shadow-md hover:shadow-lg">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tab: Change Password -->
                <div x-show="activeTab === 'password'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Change Password</h2>
                    
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        
                        <div class="space-y-6 max-w-lg">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" name="current_password" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" name="password" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 transition-all shadow-md hover:shadow-lg">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tab: My Bookings -->
                <div x-show="activeTab === 'bookings'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900">My Ride Bookings</h2>
                        <div class="flex space-x-2">
                            <!-- Placeholder for filters if needed -->
                            <span class="text-sm text-gray-500">Total: {{ $bookings->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Booking ID</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Car Name</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Rental Type</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pickup / Delivery Location</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dropoff Location</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Booked On</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Trip Start Otp</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Trip End Otp</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-500 font-bold">#{{ $booking->id }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ optional($booking->vehicleType)->name ?? $booking->cab_type ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->rental_type }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->pickup_location }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->drop_location ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $booking->book_date->format('d M, Y h:i A') }}</td>
                                    <td class="px-6 py-4 text-sm font-mono font-bold text-indigo-600 bg-indigo-50 rounded-lg text-center">{{ $booking->trip_start_otp ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm font-mono font-bold text-purple-600 bg-purple-50 rounded-lg text-center">{{ $booking->trip_end_otp ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">₹{{ number_format($booking->amount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClasses = [
                                                'Pending' => 'bg-yellow-100 text-yellow-700',
                                                'Confirmed' => 'bg-blue-100 text-blue-700',
                                                'Completed' => 'bg-green-100 text-green-700',
                                                'Cancelled' => 'bg-red-100 text-red-700',
                                            ][$booking->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            <p>No trip bookings found.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Tab: My Tours -->
                {{-- <div x-show="activeTab === 'tours'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">My Tours</h2>
                            <p class="text-sm text-gray-500 mt-1">Manage your holiday package bookings</p>
                        </div>
                        <span class="text-sm text-gray-500">Total: {{ $tourBookings->count() }}</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Package</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Destination</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Travel Dates</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Travelers</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($tourBookings as $tour)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-500">#{{ $tour->id }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ optional($tour->package)->name ?? 'Custom Tour' }}
                                        <span class="block text-xs text-gray-500">{{ optional($tour->package)->days }} Days</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $tour->drop_location ?? $tour->pickup_location }}</td> <!-- Assuming Destination is one of these -->
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div class="flex flex-col whitespace-nowrap">
                                            <span class="font-medium text-gray-800">{{ $tour->book_date->format('d M') }}</span>
                                            @if($tour->end_date)
                                                <span class="text-xs text-gray-400">to {{ \Carbon\Carbon::parse($tour->end_date)->format('d M') }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $tour->no_of_travelers ?? 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">₹{{ number_format($tour->amount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClasses = [
                                                'Pending' => 'bg-yellow-100 text-yellow-700',
                                                'Confirmed' => 'bg-green-100 text-green-700',
                                                'Completed' => 'bg-blue-100 text-blue-700',
                                                'Cancelled' => 'bg-red-100 text-red-700',
                                            ][$tour->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses }}">
                                            {{ $tour->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <button @click="openTourModal({{ json_encode($tour) }})" class="text-indigo-600 hover:text-indigo-900 font-medium text-xs bg-indigo-50 px-3 py-1.5 rounded-lg hover:bg-indigo-100 transition-colors">View Details</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>No tour bookings found.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
    <!-- Tour Details Modal -->
    <div x-show="showTourModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="showTourModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showTourModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showTourModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Tour Details <span class="text-indigo-600 font-bold" x-text="'#' + selectedTour.id"></span>
                            </h3>
                            
                            <div class="mt-4 space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-500">Package</p>
                                            <p class="font-semibold text-gray-900" x-text="selectedTour.package ? selectedTour.package.name : 'Custom Tour'"></p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Status</p>
                                            <p class="font-semibold" :class="{
                                                'text-yellow-600': selectedTour.status === 'Pending',
                                                'text-green-600': selectedTour.status === 'Confirmed',
                                                'text-blue-600': selectedTour.status === 'Completed',
                                                'text-red-600': selectedTour.status === 'Cancelled'
                                            }" x-text="selectedTour.status"></p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Travel Date</p>
                                            <p class="font-semibold text-gray-900" x-text="formatDate(selectedTour.book_date)"></p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500">Travelers</p>
                                            <p class="font-semibold text-gray-900" x-text="selectedTour.no_of_travelers || 1"></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Location</h4>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        <p class="text-gray-700" x-text="selectedTour.drop_location || selectedTour.pickup_location"></p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Payment Info</h4>
                                    <div class="flex justify-between items-center border-t border-gray-100 pt-2">
                                        <span class="text-gray-600">Total Amount</span>
                                        <span class="text-lg font-bold text-gray-900" x-text="'₹' + Number(selectedTour.amount).toLocaleString('en-IN', {minimumFractionDigits: 2})"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="showTourModal = false">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
