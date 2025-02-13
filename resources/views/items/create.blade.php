<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" 
              class="space-y-6 bg-white dark:bg-gray-800 shadow-lg dark:shadow-gray-900/50 rounded-xl p-8">
            @csrf
            <div class="space-y-6">
                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-600 dark:bg-gray-700 dark:text-white transition duration-200"
                        placeholder="Enter item name">
                </div>

                <!-- Description Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea name="description" required rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-600 dark:bg-gray-700 dark:text-white transition duration-200 resize-y"
                        placeholder="Enter item description">{{ old('description') }}</textarea>
                </div>

                <!-- Starting Bid Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Starting Bid</label>
                    <input type="number" step="0.01" name="starting_bid" value="{{ old('starting_bid') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-600 dark:bg-gray-700 dark:text-white transition duration-200"
                        placeholder="Enter starting bid">
                </div>

                <!-- End Time Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Time</label>
                    <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-600 dark:bg-gray-700 dark:text-white transition duration-200">
                </div>

                <!-- Item Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Item Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg">
                        <div class="space-y-1 text-center" id="image-input">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload a file</span>
                                    <input type="file" class="sr-only" id="item_file" name="item_pic[]" multiple >
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400"> up to 10MB</p>
                        </div>
                        <div style="position: relative; display: none;" id="image-preview">
                            <div class="preview-area"></div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
                
            <!-- Submit Button -->
            <button type="submit" 
                class="w-full bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                Create Item
            </button>
        </form>
        <script>
            
            </script>
    </div>
</x-app-layout>