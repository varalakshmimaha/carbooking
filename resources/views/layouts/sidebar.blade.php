<aside class="w-64 bg-slate-900 border-r border-slate-800 h-screen sticky top-0 overflow-y-auto">
    <div class="p-6">
        <!-- Logo -->
        <div class="mb-8">
            <h1 class="text-xl font-extrabold text-white">Car Booking</h1>
            <p class="text-xs text-gray-400 font-semibold">Admin</p>
        </div>

        <!-- Menu -->
        <nav class="space-y-6">
            <!-- DASHBOARD -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Dashboard</p>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
            </div>

            <!-- TRIPS -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Trips</p>
                <a href="{{ route('admin.trips.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.trips.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span class="font-medium">Trip</span>
                </a>
            </div>

            <!-- USERS -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Users</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.drivers.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.drivers.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Drivers</span>
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.customers.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="font-medium">Customers</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="font-medium">Admins & Staff</span>
                    </a>
                </div>
            </div>

            <!-- VEHICLES -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Vehicles</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.vehicles.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.vehicles.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">All Vehicles</span>
                    </a>
                </div>
            </div>

            <!-- PACKAGES -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Packages</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.packages.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span class="font-medium">Packages</span>
                    </a>
                    <a href="{{ route('admin.driver-packages.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.driver-packages.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                        <span class="font-medium">Driver Packages</span>
                    </a>
                </div>
            </div>

            <!-- RATE -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Rate</p>
                <a href="{{ route('admin.rates.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.rates.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Rate</span>
                </a>
            </div>

            <!-- ROUTES -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Routes</p>
                <a href="{{ route('admin.routes.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.routes.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span class="font-medium">Routes</span>
                </a>
            </div>

            <!-- MENU MANAGEMENT -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Navigation</p>
                <a href="{{ route('admin.menus.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.menus.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="font-medium">Menus</span>
                </a>
            </div>

            <!-- PAGES / BUILDER & CONTENT -->
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Website Content</p>
                
                {{-- Pages Builder --}}
                <a href="{{ route('admin.pages.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.pages.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors mb-1">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Pages Builder</span>
                </a>

                {{-- Services --}}
                <a href="{{ route('admin.services.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors mb-1">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Services</span>
                </a>

                {{-- Blog --}}
                <div x-data="{ open: {{ request()->routeIs('admin.blog.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-gray-300 hover:bg-slate-800 hover:text-white transition-colors mb-1">
                        <div class="flex items-center space-x-3">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <span class="font-medium">Blog</span>
                        </div>
                        <svg class="h-4 w-4 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="pl-12 space-y-1 mb-1">
                        <a href="{{ route('admin.blog.posts.index') }}" class="block py-2 text-sm {{ request()->routeIs('admin.blog.posts.*') ? 'text-white font-semibold' : 'text-gray-400 hover:text-white' }}">Posts</a>
                        <a href="{{ route('admin.blog-categories.index') }}" class="block py-2 text-sm {{ request()->routeIs('admin.blog-categories.*') ? 'text-white font-semibold' : 'text-gray-400 hover:text-white' }}">Categories</a>
                        <a href="{{ route('admin.blog-tags.index') }}" class="block py-2 text-sm {{ request()->routeIs('admin.blog-tags.*') ? 'text-white font-semibold' : 'text-gray-400 hover:text-white' }}">Tags</a>
                    </div>
                </div>

                {{-- Testimonials --}}
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span class="font-medium">Testimonials</span>
                </a>
            </div>

            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Setting</p>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium">Setting</span>
                </a>
            </div>

            <!-- LOG OUT -->
            <div class="pt-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to log out?');">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-red-400 hover:bg-slate-800 transition-colors w-full">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-medium">Log Out</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>
</aside>
