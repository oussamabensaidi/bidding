<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Tracking</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js' ,'resources/js/echo.js'])
</head>
<body class="p-8 bg-gray-100 dark:bg-gray-900 dark:text-white">
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 mb-6 rounded-lg">
                <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif
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
            <form action="{{route('trackItemsUpdateStateForm',$item)}}" method="POST" id="statusForm">
                @csrf
                @method('PUT')
            <h2 class="text-xl font-semibold mb-4">Update Shipment Status</h2>
            <select id="statusSelect" class="w-full p-2 border rounded-lg" name="status" required>
                <option value="Select" selected disabled>Select the current situation :</option>
                <option value="Pending">Pending</option>
                <option value="Shipped">Shipped</option>
                <option value="Delivered">Delivered</option>
            </select>
            <script>
                document.getElementById('statusSelect').addEventListener('change', function (e) {
                  const confirmed = confirm('Are you sure you want to update the status?');
                  if (!confirmed) {
                    // Undo the selection change by resetting it
                    this.value = this.getAttribute('data-previous') || 'Pending';
                  } else {
                    this.setAttribute('data-previous', this.value); // Save current selection
                  }
                });
              </script>
        </form>
        </div>
    </div>
<input type="hidden" name="" value="{{$item->shipping_status}}" id="status_value">
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
                Pending: { text: 'Pending', color: 'bg-gray-500', progress: 0 },
                Shipped: { text: 'Shipped', color: 'bg-yellow-500', progress: 50 },
                Delivered: { text: 'Delivered', color: 'bg-green-500', progress: 100 }
            };
            
            const { text, color, progress } = statusMap[status];
            statusDiv.textContent = text;
            statusDiv.className = `p-4 rounded-lg text-center font-medium transition-all ${color} text-white`;
            
            createChart(progress);
        }
        
        // Initial status
        let currentStatus = document.getElementById('status_value').value ; 
        updateStatus(currentStatus);
        
        // Event listener for select
        document.getElementById('statusSelect').addEventListener('change', function(e) {
            currentStatus = e.target.value;
            updateStatus(currentStatus);
            document.getElementById('statusForm').submit(); // Submit the form
        });
    </script>
</body>
</html>
    
</x-app-layout>