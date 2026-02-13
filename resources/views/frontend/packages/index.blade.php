@extends('layouts.frontend')

@section('title', 'Travel Packages | ' . config('app.name'))

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    <!-- Hero Section -->
    <section class="relative bg-blue-900 text-white py-24">
        <div class="absolute inset-0 overflow-hidden">
             <img src="{{ asset('images/hero_bg_packages.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2021&q=80'" class="w-full h-full object-cover opacity-20" alt="Travel Background">
        </div>
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Explore Our Travel Packages</h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">Discover improved travel experiences with our curated holiday packages designed for your comfort.</p>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="max-w-7xl mx-auto px-6 -mt-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $package)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    <!-- Placeholder Image (Since no image column in DB yet) -->
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-indigo-600 relative flex items-center justify-center overflow-hidden group">
                        <!-- Pseudo-image / Pattern -->
                        <span class="text-white opacity-20 text-9xl font-bold absolute -bottom-4 -right-4 transform group-hover:scale-110 transition-transform">{{ substr($package->name, 0, 1) }}</span>
                        
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-blue-800 uppercase tracking-wide">
                            {{ $package->days }} Days / {{ $package->days - 1 }} Nights
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $package->name }}</h3>
                        </div>
                        
                        <p class="text-gray-600 mb-6 text-sm line-clamp-3 flex-1">{{ Str::limit($package->description, 100) }}</p>
                        
                        <div class="border-t border-gray-100 pt-4 mt-auto">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <span class="text-xs text-gray-400 uppercase font-bold">Starting From</span>
                                    <div class="text-2xl font-extrabold text-blue-600">₹{{ number_format($package->amount) }}</div>
                                </div>
                            </div>
                            
                            <a href="{{ route('user.booking.index', ['trip_type' => 'roundtrip', 'package_id' => $package->id]) }}" 
                               class="block w-full text-center bg-gray-900 text-white font-bold py-3 rounded-xl hover:bg-blue-600 transition-colors">
                                Book This Package
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl shadow-sm">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900">No Packages Found</h3>
                    <p class="text-gray-500 mt-2">We are currently updating our travel packages. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
