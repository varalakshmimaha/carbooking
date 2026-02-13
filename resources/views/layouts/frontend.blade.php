<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name'))</title>
        <meta name="description" content="@yield('meta_description', '')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Fallback Alpine if build fails -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            body { font-family: 'Outfit', sans-serif; }
            [x-cloak] { display: none !important; }
        </style>
        @stack('styles')
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Setting::get('favicon', 'favicon.ico')) }}">
    </head>
    <body class="antialiased bg-gray-50">
        
        <!-- Header Navigation Bar -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ profileOpen: false }">
            <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    @php $logo = \App\Models\Setting::get('logo'); @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-10 w-auto rounded-xl">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    @endif
                    <span class="text-xl font-bold text-gray-900">Car Booking</span>
                </a>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8">
                    @if(isset($headerMenu) && $headerMenu->items->isNotEmpty())
                        @foreach($headerMenu->items as $item)
                            <a href="{{ $item->url }}" 
                               class="{{ Request::is(trim($item->url, '/')) ? 'text-indigo-600' : 'text-gray-600' }} font-semibold hover:text-indigo-600 transition-colors">
                                {{ $item->label }}
                            </a>
                        @endforeach
                    @endif
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors">Admin Panel</a>
                        @else
                            <div class="relative flex items-center space-x-3">
                                <!-- Profile Button Removed -->

                                <!-- Dropdown Toggle -->
                                <button @click="profileOpen = !profileOpen" class="flex items-center space-x-1 hover:bg-gray-50 rounded-lg p-2 transition-colors border border-gray-100">
                                    <div class="w-8 h-8 md:w-9 md:h-9 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="profileOpen" @click.away="profileOpen = false" x-cloak x-transition
                                    class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-[60]">
                                    <div class="px-4 py-2 border-b border-gray-50">
                                        <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        My Dashboard
                                    </a>
                                    <!-- My Trips Link Removed -->
                                    <hr class="my-2 border-gray-50">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-gray-700 font-semibold hover:text-indigo-600 transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition-colors">Get Started</a>
                    @endauth
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.footer')

        @stack('scripts')
    </body>
</html>
