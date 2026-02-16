<nav x-data="{ open: false }" class="bg-gray-800 text-white w-64 min-h-screen hidden md:flex flex-col fixed left-0 top-0 overflow-y-auto">
    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-700">
        <a href="{{ route('driver.dashboard') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-8 w-auto fill-current text-white" />
            <span class="text-xl font-bold tracking-wider">DRIVER APP</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 px-4 py-6 space-y-4">
        <!-- Dashboard -->
        <a href="{{ route('driver.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('driver.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- My Rides -->
        <a href="{{ route('driver.trips.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('driver.trips.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }} group">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
             <span class="font-medium">My Rides</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('driver.profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('driver.profile.edit') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="font-medium">Profile</span>
        </a>
    </div>

    <!-- User Info & Sign Out -->
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center space-x-3 mb-4 px-2">
            <div class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center text-lg font-bold">
                {{ substr(Auth::guard('driver')->user()->name, 0, 1) }}
            </div>
            <div>
                <p class="text-sm font-semibold">{{ Auth::guard('driver')->user()->name }}</p>
                <p class="text-xs text-gray-400">Driver</p>
            </div>
        </div>
        <form method="POST" action="{{ route('driver.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</nav>

<!-- Mobile Navigation (Bottom Bar or Slide-out) - Simplified for now -->
<div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around p-3 z-50">
    <a href="{{ route('driver.dashboard') }}" class="flex flex-col items-center {{ request()->routeIs('driver.dashboard') ? 'text-blue-600' : 'text-gray-500' }}">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        <span class="text-xs mt-1">Home</span>
    </a>
    <a href="{{ route('driver.trips.index') }}" class="flex flex-col items-center {{ request()->routeIs('driver.trips.*') ? 'text-blue-600' : 'text-gray-500' }}">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span class="text-xs mt-1">Rides</span>
    </a>
    <form method="POST" action="{{ route('driver.logout') }}" class="flex flex-col items-center">
        @csrf
        <button type="submit" class="flex flex-col items-center text-gray-500">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            <span class="text-xs mt-1">Logout</span>
        </button>
    </form>
</div>
