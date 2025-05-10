<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js' ,'resources/js/echo.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-purple-50 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-lg shadow-purple-100 dark:bg-gray-800 dark:shadow-lg dark:shadow-purple-900">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <div>
                            {{ $header }}
                        </div>
                        <div>
                            <form method="GET" action="{{ route('items') }}" class="flex items-center">
                                <input type="text" name="search" placeholder="Search items..." class="border px-4 py-2 rounded">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Search</button>
                            </form>
                        </div>
                    </div>
                </header>
            @endisset
            @isset($advancedSearch)
                <header class="bg-white shadow-lg shadow-purple-100 dark:bg-gray-800 dark:shadow-purple-900">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('items_search') }}" class="space-y-4 md:space-y-0">
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search items..." 
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100 transition-all"
                >
            </div>

            <!-- Filters Container -->
            <div class="flex flex-wrap gap-4 items-center">

                <!-- Sort By Latest -->
                <div class="flex items-center space-x-2 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded-lg">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sort By :
                    </label>
                    <input 
                        type="radio" 
                        name="price" 
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600 "
                    >
               
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Latest</span>
                    <div class="flex items-center space-x-2">
                        <label class="flex items-center space-x-1">
                            <input 
                                type="radio" 
                                name="price" 
                                value="expensive" 
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600"
                            >
                            <span class="text-sm text-gray-700 dark:text-gray-300">Expensive</span>
                        </label>
                        <label class="flex items-center space-x-1">
                            <input 
                                type="radio" 
                                name="price" 
                                value="cheapest" 
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600"
                            >
                            <span class="text-sm text-gray-700 dark:text-gray-300">Cheapest</span>
                        </label>
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="flex items-center space-x-3 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded-lg">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Status:</span>
                    <div class="flex items-center space-x-2">
                        <label class="flex items-center space-x-1">
                            <input 
                                type="radio" 
                                name="statu" 
                                value="live" 
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600"
                            >
                            <span class="text-sm text-gray-700 dark:text-gray-300">Live Now</span>
                        </label>
                        <label class="flex items-center space-x-1">
                            <input 
                                type="radio" 
                                name="statu" 
                                value="soon" 
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600"
                            >
                            <span class="text-sm text-gray-700 dark:text-gray-300">Live Soon</span>
                        </label>
                        <label class="flex items-center space-x-1">
                            <input 
                                type="radio" 
                                name="statu" 
                                value="ended" 
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600"
                            >
                            <span class="text-sm text-gray-700 dark:text-gray-300">Ended</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="ml-auto bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                >
                    Search
                </button>
            </div>
        </form>
    </div>
</header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }} 
            </main>
        </div>
    </body>
</html>
