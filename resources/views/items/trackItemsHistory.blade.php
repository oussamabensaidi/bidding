<x-app-layout>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Image Gallery Section -->
                <div class="relative">
                    @php
                        $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
                    @endphp
                    
                    <!-- Main Image -->
                    <div class="relative rounded-lg overflow-hidden shadow-xl">
                        <img id="current-image" 
                             src="{{ count($pics) ? Storage::url($pics[0]) : 'https://via.placeholder.com/800x600' }}" 
                             alt="Item image" 
                             class="w-full h-96 object-cover transition-opacity duration-300">
                    </div>

                    <!-- Navigation Controls -->
                    @if(count($pics) > 1)
                    <div class="flex justify-between items-center mt-4">
                        <button id="prev-btn" class="p-2 bg-white dark:bg-gray-800 rounded-full shadow-md hover:shadow-lg transition-shadow">
                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <div class="flex space-x-2">
                            @foreach($pics as $index => $pic)
                            <img src="{{ Storage::url($pic) }}" 
                                 data-index="{{ $index }}"
                                 class="thumbnail w-16 h-12 object-cover cursor-pointer rounded border-2 {{ $index === 0 ? 'border-blue-500' : 'border-transparent' }} hover:border-blue-300 transition-all">
                            @endforeach
                        </div>

                        <button id="next-btn" class="p-2 bg-white dark:bg-gray-800 rounded-full shadow-md hover:shadow-lg transition-shadow">
                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Item Details Section -->
                <div class="space-y-6 dark:text-gray-100">

                    <!-- Item Title -->
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $item->name }}</h1>

                    <!-- Price Information -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Last Bid</p>
                            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                ${{ number_format($item->current_bid ?? $item->starting_bid, 2) }}
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Starting Price</p>
                            <p class="text-2xl line-through text-gray-400 dark:text-gray-500">
                                ${{ number_format($item->starting_bid, 2) }}
                            </p>
                        </div>
                    </div>

                    <!-- Auction Timeline -->
                    <div class="space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Start Time</span>
                            <span class="text-gray-900 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($item->start_time)->format('M j, Y g:i A') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">End Time</span>
                            <span class="text-gray-900 dark:text-gray-200">{{ $item->end_time->format('M j, Y g:i A') }}</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        @foreach($bids as $bid)
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-500 dark:text-gray-400">Bid by {{ $bid->user->name }}</span>
                                <span class="text-gray-900 dark:text-gray-200">${{ number_format($bid->amount, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Shipping Info -->
                    @if($item->shipping_status)
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold mb-3">Shipping Information</h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ ucwords(str_replace('_', ' ', $item->shipping_status)) }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = @json($pics);
            if(images.length < 2) return;

            const currentImage = document.getElementById('current-image');
            const thumbnails = document.querySelectorAll('.thumbnail');
            let currentIndex = 0;

            // Button handlers
            document.getElementById('prev-btn').addEventListener('click', () => updateImage(-1));
            document.getElementById('next-btn').addEventListener('click', () => updateImage(1));

            // Thumbnail click handlers
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    currentIndex = parseInt(thumb.dataset.index);
                    updateImage(0);
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if(e.key === 'ArrowLeft') updateImage(-1);
                if(e.key === 'ArrowRight') updateImage(1);
            });

            function updateImage(change) {
                currentIndex = (currentIndex + change + images.length) % images.length;
                currentImage.src = "{{ Storage::url('') }}" + images[currentIndex];

                
                // Update thumbnail borders
                thumbnails.forEach((thumb, index) => {
                    thumb.classList.toggle('border-blue-500', index === currentIndex);
                    thumb.classList.toggle('border-transparent', index !== currentIndex);
                });
            }
        });
    </script>

    <style>
        .thumbnail {
            transition: border-color 0.2s ease, transform 0.2s ease;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        #current-image {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</x-app-layout>