<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8 text-center mt-6">
        <div class="bg-gray-500 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">All Items</h5>
            <p class="text-3xl font-bold mt-2" id="">{{$items_count}}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">Live Items</h5>
            <p class="text-3xl font-bold mt-2" id="live-count">0</p>
        </div>
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">Not Started</h5>
            <p class="text-3xl font-bold mt-2" id="not-started-count">0</p>
        </div>
        <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold">Ended Items</h5>
            <p class="text-3xl font-bold mt-2" id="ended-count">0</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
        <canvas id="statusChart" class="w-120 h-120"></canvas>
    </div>
    

    <script>
        // Dummy Data
        const itemStatus = {
            ended: 12,
            notStarted: 8,
            live: 15
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
