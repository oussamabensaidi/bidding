<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Client Dashboard</h1>

        <!-- Recommended for You Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Recommended for You</h2>
            <canvas id="recommendedItemsChart" width="400" height="200"></canvas>
        </div>

        <!-- Recently Popular Items Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Recently Popular Items</h2>
            <canvas id="popularItemsChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Recommended for You Chart
        const recommendedItemsCtx = document.getElementById('recommendedItemsChart').getContext('2d');
        new Chart(recommendedItemsCtx, {
            type: 'radar',
            data: {
                labels: ['Item X', 'Item Y', 'Item Z', 'Item W', 'Item V'],
                datasets: [{
                    label: 'Recommendation Score',
                    data: [8, 7, 9, 6, 8],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Recently Popular Items Chart
        const popularItemsCtx = document.getElementById('popularItemsChart').getContext('2d');
        new Chart(popularItemsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Item A', 'Item B', 'Item C', 'Item D', 'Item E'],
                datasets: [{
                    label: 'Popularity',
                    data: [20, 15, 30, 25, 10],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</x-app-layout>