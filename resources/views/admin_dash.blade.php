<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8 text-center mt-6">
        <div class="bg-gray-500 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">All Items</h5>
            <p class="text-3xl font-bold mt-2" id="">{{$items_count}}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">Live Items</h5>
            <p class="text-3xl font-bold mt-2" id="live-count">{{ $live_count }}</p>
        </div>
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">Not Started</h5>
            <p class="text-3xl font-bold mt-2" id="not-started-count">{{ $not_started_count }}</p>
        </div>
        <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">Ended Items</h5>
            <p class="text-3xl font-bold mt-2" id="ended-count">{{ $ended_count }}</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl mx-auto mt-6">
        <canvas id="statusChart" class="w-full h-96"></canvas>
    </div>
    
    

    <script>
    const itemStatus = {
        ended: {{ $ended_count }},
        notStarted: {{ $not_started_count }},
        live: {{ $live_count }}
    };

    // Update Cards
    document.getElementById('ended-count').textContent = itemStatus.ended;
    document.getElementById('not-started-count').textContent = itemStatus.notStarted;
    document.getElementById('live-count').textContent = itemStatus.live;

    // Chart.js Configuration
    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ended', 'Not Started', 'Live'],
            datasets: [{
                label: 'Item Count',
                data: [itemStatus.ended, itemStatus.notStarted, itemStatus.live],
                backgroundColor: ['#ef4444', '#4b5563', '#22c55e'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    </script>
</x-app-layout>
