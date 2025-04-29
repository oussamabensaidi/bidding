<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Tracking</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="p-8 bg-gray-100">
    <div class="max-w-4xl mx-auto">
        <!-- Progress Chart -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Shipment Progress</h2>
            <div class="w-48 h-48 mx-auto">
                <canvas id="progressChart"></canvas>
            </div>
        </div>

        <!-- Shipment Status -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Current Status</h2>
            <div id="currentStatus" class="p-4 rounded-lg text-center font-medium transition-all">
                <!-- Status will be displayed here -->
            </div>
        </div>

        <!-- Status Selector -->

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="">
            <h2 class="text-xl font-semibold mb-4">Update Shipment Status</h2>
            <select id="statusSelect" class="w-full p-2 border rounded-lg" >
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="in_transit">In Transit</option>
                <option value="delivered">Delivered</option>
            </select>
            <script>
                document.getElementById('statusSelect').addEventListener('change', function (e) {
                  const confirmed = confirm('Are you sure you want to update the status?');
                  if (!confirmed) {
                    // Undo the selection change by resetting it
                    this.value = this.getAttribute('data-previous') || 'pending';
                  } else {
                    this.setAttribute('data-previous', this.value); // Save current selection
                  }
                });
              </script>
        </form>
        </div>
    </div>

    <script>
        // Chart initialization
        let progressChart;

        function createChart(percentage) {
            const ctx = document.getElementById('progressChart').getContext('2d');
            
            if (progressChart) {
                progressChart.destroy();
            }

            progressChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [percentage, 100 - percentage],
                        backgroundColor: ['#3B82F6', '#E5E7EB'],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '80%',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                }
            });
        }

        // Status handling
        function updateStatus(status) {
            const statusDiv = document.getElementById('currentStatus');
            const statusMap = {
                pending: { text: 'Pending', color: 'bg-gray-500', progress: 0 },
                processing: { text: 'Processing', color: 'bg-blue-500', progress: 25 },
                shipped: { text: 'Shipped', color: 'bg-yellow-500', progress: 50 },
                in_transit: { text: 'In Transit', color: 'bg-orange-500', progress: 75 },
                delivered: { text: 'Delivered', color: 'bg-green-500', progress: 100 }
            };

            const { text, color, progress } = statusMap[status];
            statusDiv.textContent = text;
            statusDiv.className = `p-4 rounded-lg text-center font-medium transition-all ${color} text-white`;
            
            createChart(progress);
        }

        // Initial status
        let currentStatus = 'pending';
        updateStatus(currentStatus);

        // Event listener for select
        document.getElementById('statusSelect').addEventListener('change', function(e) {
            currentStatus = e.target.value;
            updateStatus(currentStatus);
        });
    </script>
</body>
</html>
    
</x-app-layout>