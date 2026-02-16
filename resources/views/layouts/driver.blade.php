<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Driver Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('layouts.driver-navigation')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col w-full md:ml-64 relative overflow-y-auto">
        
        <!-- Header -->
        @if (isset($header))
            <header class="bg-white shadow sticky top-0 z-10 w-full">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    {{ $header }}
                    
                    <!-- Mobile Menu Button (Optional, if not using bottom bar) -->
                    {{-- <button class="md:hidden ...">Menu</button> --}}
                    
                    <div class="hidden md:flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
            </header>
        @endif

        <!-- Content -->
        <main class="flex-1 p-6 pb-24 md:pb-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
