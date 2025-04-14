<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-bold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All Items') }}
            </h2>
        </x-slot>

        <!-- Search Results Banner -->
        <div class="container mx-auto px-4">
            @isset($searchPerformed)
                @if($searchPerformed)
                    <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 mb-6 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-indigo-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-indigo-700 font-medium">Search results for: <span class="text-indigo-900">{{ $search }}</span></p>
                        </div>
                    </div>
                    <!-- Highlighting script remains the same -->
                @endif
            @endisset
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 mb-6 rounded-lg">
                <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Create Button -->
        @can('isAdmin', App\Models\Item::class)
            <div class="mb-8">
                <a href="{{ route('items.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-500 border border-transparent rounded-md font-semibold text-white hover:from-purple-700 hover:to-blue-600 transition-all transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Item
                </a>
            </div>
        @endcan

        <!-- Items Grid -->
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-8">
            @foreach ($items as $item)
                @php
                    $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
                @endphp
                
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700 group"> --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-8">
                @foreach ($items as $item)
                @php
                        $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
                        @endphp
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700 group">
                                
                                
                    <!-- Image Section -->

                    <div class="relative w-full h-56 bg-gray-100 dark:bg-gray-900 flex items-center justify-center overflow-hidden">
                        @if (!empty($pics))
                            <img 
                                src="{{ Storage::url($pics[0]) }}" 
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300"
                                alt="{{ $item->name }}"
                            >
                        @else
                            <div class="text-gray-400 dark:text-gray-600">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Timer -->
                    <div id="timer-{{ $item->id }}" class="mx-4 mt-4"></div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-gray-100 hover:text-purple-600 dark:hover:text-purple-400 transition-colors">
                            <a href="{{ route('items.show', $item) }}">{{ $item->name }}</a>
                        </h3>
                        
                        <div class="flex items-center justify-center mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                ${{ number_format($item->current_bid, 2) }}
                            </span>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col space-y-2">
                            @can('isAdmin', App\Models\Item::class)
                                <a href="{{ route('items.edit', $item) }}" class="flex items-center justify-center px-4 py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Edit
                                </a>
                                <a href="{{ route('items.show', $item) }}" class="flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Details
                                </a>
                            @else
                                <a href="{{ route('captcha.show', $item) }}" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white rounded-lg font-medium transition-all transform hover:scale-[1.02] shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Place Bid
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mb-8">
            {{ $items->links() }}
        </div>
    </div>

    <!-- Timer Script remains unchanged -->
</x-app-layout>