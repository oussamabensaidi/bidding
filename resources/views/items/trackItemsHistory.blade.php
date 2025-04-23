<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Tracking</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Order #FAKE12345</h1>
        
        <!-- Delivery Status Timeline -->
        <div class="mb-8">
            <div class="flex justify-between mb-4">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white">
                        ✓
                    </div>
                    <span class="mt-2 text-sm font-medium">Ordered</span>
                    <span class="text-xs text-gray-500">2023-12-20</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                        ✓
                    </div>
                    <span class="mt-2 text-sm font-medium">Processed</span>
                    <span class="text-xs text-gray-500">2023-12-21</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                        3
                    </div>
                    <span class="mt-2 text-sm font-medium text-blue-500">Shipped</span>
                    <span class="text-xs text-gray-500">2023-12-22</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        4
                    </div>
                    <span class="mt-2 text-sm font-medium text-gray-500">Delivered</span>
                </div>
            </div>
            <div class="h-1 bg-gray-200 -mt-4 mx-8">
                <div class="h-full bg-blue-500 w-2/3"></div>
            </div>
        </div>

        <!-- Delivery Details -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Item</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tracking Number</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Last Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3 text-sm">Fake Product X</td>
                        <td class="px-4 py-3 text-sm font-mono">FAKE987654321</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                In Transit
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">2023-12-22 14:30</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-sm">Sample Item Y</td>
                        <td class="px-4 py-3 text-sm font-mono">FAKE112233445</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                Delivered
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">2023-12-20 09:15</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Admin Note (Demo Only) -->
        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
            <p class="text-sm text-yellow-800">
                ⚠️ Demo Note: This is a static demonstration. Admin interface would include status update controls and real-time database integration.
            </p>
        </div>
    </div>
</body>
</html>