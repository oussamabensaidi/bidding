<x-app-layout>
    @vite(['resources/js/bidding.js'])
    <div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Image Container -->
            @php
                $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
            @endphp 
           
       
            <div class="md:sticky md:top-4 h-fit">
                <div class="relative group">
                    <img id="current-image" 
                         src="{{ Storage::url($pics[0]) }}"
                         alt="Gallery image"
                         class="w-full h-96 object-cover rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl dark:border dark:border-gray-700">
                <!-- Navigation Buttons -->
                <button id="prev-btn" 
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 dark:bg-gray-700/80 dark:hover:bg-gray-600/90 rounded-full p-3 m-4 transition-all duration-200 transform hover:scale-110">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <button id="next-btn" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 dark:bg-gray-700/80 dark:hover:bg-gray-600/90 rounded-full p-3 m-4 transition-all duration-200 transform hover:scale-110">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            </div>

            <!-- Auction Details -->
            <div class="space-y-6">
                <!-- Auction Details Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h2 class="text-3xl font-bold mb-4 border-b pb-2 dark:border-gray-600">Auction Details</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-300">Starting price:</span>
                            <span class="font-semibold">${{ $item->starting_bid }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-300">Current price:</span>
                            <span class="font-semibold text-green-600 dark:text-green-400" id="current-bid-amount">${{ $item->current_bid }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-300">Live Participants:</span>
                            <span class="font-semibold">{{ $item->people_live }}</span>
                        </div>
                    </div>
                </div>
                <!-- Bid Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md">
                    <form action="{{ route('items.updateBid', $item->id) }}" method="POST" id="bidForm" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col md:flex-row gap-4">
                            <input type="number" name="bid_amount" 
                                class="flex-1 border rounded-lg p-3 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter bid amount" min="{{ $item->current_bid + 1 }}">
                            <button type="button" 
                                    class="bg-green-500 hover:bg-green-600 text-white rounded-lg px-8 py-3 transition-colors duration-200"
                                    id="openModal">
                                Place Bid
                            </button>
                        </div>
                        @if (session('error'))
                            <div class="text-red-500 text-sm">{{ session('error') }}</div>
                        @endif
                    </form>
                </div>
                <!-- Comment Section -->
                 <!-- Comment Section Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold">Live Comments</h3>
                    
                    <!-- Comments Container -->
                    <div id="commentLive" class="space-y-4 h-64 overflow-y-auto pr-2">
                        @foreach($item->comments as $c)
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg transition-all hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex items-start gap-3">
                                    <div class="flex-1">
                                        <p class="text-gray-800 dark:text-gray-200 mb-1 font-semibold">{{ $c->user->name }}</p>
                                        <p class="text-gray-800 dark:text-gray-200 mb-1">{{ $c->comment }}</p>
                                        <small class="text-gray-500 dark:text-gray-400 text-sm">{{ $c->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Comment Input -->
                    <form action="{{ route('comment')}}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}" id="item_id">
                        <input type="hidden" name="currentUserId" value="{{ Auth::id()}}" id="currentUserId">
                        
                        <div class="flex gap-3">
                            <input type="text" name="comment" 
                                   class="flex-1 border rounded-lg p-3 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500"
                                   placeholder="Write your comment...">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-6 py-3 transition-colors duration-200 shadow-sm">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>

                
            </div>

            <!-- Payment Modal -->
            <div id="paymentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-96 transform transition-all">
                    <div class="flex justify-between items-center pb-4 border-b dark:border-gray-600">
                        <h5 class="text-xl font-semibold">Payment Method</h5>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-2xl">&times;</button>
                    </div>
                    <div class="mt-6 space-y-4">
                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.5 2.5a3.5 3.5 0 0 0-3.45 4H6.5a3 3 0 0 0 0 6h2.05a3.5 3.5 0 0 0 6.9 0h3.55a1 1 0 0 0 0-2h-3.55a3.5 3.5 0 0 0-6.9 0H6.5a1 1 0 0 1 0-2h2.55a3.5 3.5 0 0 0 6.9 0h3.55a3 3 0 0 0 0-6h-2.55a3.5 3.5 0 0 0-3.45-3.5z"/></svg>
                            PayPal
                        </button>
                        
                        <div class="space-y-3">
                            <div class="relative">
                                <input type="text" 
                                       class="w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600" 
                                       placeholder="Card Number"
                                       disabled>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <input type="text" 
                                       class="p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600" 
                                       placeholder="MM/YY"
                                       disabled>
                                <input type="text" 
                                       class="p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600" 
                                       placeholder="CVV"
                                       disabled>
                                <div class="relative group">
                                    <button class="w-full h-full bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                        ?
                                    </button>
                                    <div class="absolute hidden group-hover:block bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-3 py-1 rounded-lg whitespace-nowrap">
                                        Demo payment - no real processing
                                    </div>
                                </div>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg transition-colors duration-200"
                                    id="paybutton">
                                Confirm Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get elements from DOM
        const currentImage = document.getElementById('current-image');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
    
        // Image array - replace with your Laravel image paths
        const images = @json($pics); // Pass images array from controller
        let currentIndex = 0;
    
        // Function to update image
        function updateImage(index) {
            currentImage.src = "{{ Storage::url('') }}" + images[index];
            currentImage.alt = `Image ${index + 1}`;
        }
    
        // Previous button click handler
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateImage(currentIndex);
        });
    
        // Next button click handler
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            updateImage(currentIndex);
        });
    
        //  Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                prevBtn.click();
            } else if (e.key === 'ArrowRight') {
                nextBtn.click();
            }
        });
    </script>
</x-app-layout>