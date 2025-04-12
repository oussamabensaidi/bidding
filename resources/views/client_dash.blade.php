<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Items Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 p-3 rounded-full">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Items</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $items_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Live Auctions Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 p-3 rounded-full">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Live Auctions</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $live_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Auctions Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 p-3 rounded-full">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Upcoming</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $not_started_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ended Auctions Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 p-3 rounded-full">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ended</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $ended_count }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Items Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Recently Added Items</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($featuredItems as $item)
                        <div class="border rounded-lg p-4 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            @if($item->item_pic)
                            <img src="{{ asset('storage/' . $item->item_pic) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover rounded mb-4">
                            @endif
                            <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">{{ $item->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                                {{ $item->description }}
                            </p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="px-2 py-1 rounded 
                                    @if($item->end_time > now() && $item->start_time <= now())
                                        bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                    @elseif($item->start_time > now())
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                    @else
                                        bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                    @endif">
                                    @if($item->end_time > now() && $item->start_time <= now())
                                        Live
                                    @elseif($item->start_time > now())
                                        Upcoming
                                    @else
                                        Ended
                                    @endif
                                </span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    {{ $item->starting_bid ? number_format($item->starting_bid, 2) . ' USD' : 'No bids' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No items found</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Auction Status Distribution</h3>
                <div class="chart-container" style="position: relative; height:300px; width:100%">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('statusChart').getContext('2d');
                const darkMode = document.documentElement.classList.contains('dark');
                
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Live Auctions', 'Upcoming', 'Ended'],
                        datasets: [{
                            label: 'Number of Items',
                            data: [{{ $live_count }}, {{ $not_started_count }}, {{ $ended_count }}],
                            backgroundColor: [
                                darkMode ? '#10B981' : '#6EE7B7',
                                darkMode ? '#F59E0B' : '#FCD34D',
                                darkMode ? '#EF4444' : '#FCA5A5'
                            ],
                            borderColor: [
                                darkMode ? '#059669' : '#10B981',
                                darkMode ? '#D97706' : '#F59E0B',
                                darkMode ? '#DC2626' : '#EF4444'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                                labels: {
                                    color: darkMode ? '#e5e7eb' : '#374151'
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: darkMode ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)'
                                },
                                ticks: {
                                    color: darkMode ? '#9ca3af' : '#6b7280'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: darkMode ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)'
                                },
                                ticks: {
                                    color: darkMode ? '#9ca3af' : '#6b7280'
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>