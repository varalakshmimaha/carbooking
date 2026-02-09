<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Outfit', sans-serif;
            }
            .auth-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .gradient-bg {
                background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
            }
        </style>
    </head>
    <body class="antialiased text-gray-900 gradient-bg min-h-screen flex flex-col justify-center items-center p-6">
        
        <div class="w-full sm:max-w-md">
            {{-- Logo Section - Hidden for login --}}
            {{--
            <div class="flex flex-col items-center mb-10 group">
                <a href="/" class="flex flex-col items-center">
                    <div class="h-16 w-16 bg-black rounded-2xl flex items-center justify-center mb-4 shadow-2xl group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-black leading-tight">GENERATION NEXT</span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Cab Management</span>
                </a>
            </div>
            --}}

            <!-- Content Card -->
            <div class="auth-card rounded-[32px] shadow-2xl shadow-black/5 p-8 md:p-10 border border-white/50">
                {{ $slot }}
            </div>

            {{-- Footer Links - Hidden --}}
            {{--
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-400 font-medium tracking-tight">
                    &copy; {{ date('Y') }} GENERATION NEXT. Built for comfort.
                </p>
            </div>
            --}}
        </div>
    </body>
</html>
