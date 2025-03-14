<x-app-layout>
    <div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
        <div class="relative max-w-4xl mx-auto">
            <!-- Image Container -->
            @php
                $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
            @endphp 
            <div class="relative group">
                <img id="current-image" 
                     src="{{ Storage::url($pics[0]) }}" 
                     alt="Gallery image" 
                     class="w-full h-96 object-cover rounded-lg shadow-lg transition-opacity duration-300 hover:shadow-xl">
                
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

            <!-- Auction Details -->
            <div class="mt-8 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md">
                    <h2 class="text-3xl font-bold mb-4 border-b pb-2 dark:border-gray-600">Auction Details</h2>
                    <div class="space-y-3">
                        <p class="text-lg"><strong>Starting price:</strong> ${{ $item->starting_bid }}</p>
                        <p class="text-lg" id="current-bid-amount"><strong>Current price:</strong> ${{ $item->current_bid }}</p>
                        <p class="text-lg"><strong>Live Participants:</strong> {{ $item->people_live }}</p>
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
                    </form>
                </div>
                <!-- Comment Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md">
                <h3 class="text-xl font-semibold mb-4">Live Comments</h3>
                <form action="{{ route('comment')}}" method="POST" class="mt-4 flex gap-2">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="text" name="comment" 
                               class="flex-1 border rounded-lg p-3 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your comment...">
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-6 py-3 transition-colors duration-200">
                            Send
                        </button>
                    </form>
                    <div id="commentLive" class="comment-section space-y-4 h-64 overflow-y-auto p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        @foreach($item->comments as $c)
                            <div class="bg-white dark:bg-gray-600 p-3 rounded-md shadow-sm">
                                <p class="text-gray-800 dark:text-gray-200">{{ $c->comment }}</p>
                                <small class="text-gray-500 dark:text-gray-400 text-sm">{{ $c->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
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

    <!-- Scripts remain the same -->
    <script>
        document.getElementById('openModal').addEventListener('click', () => {
            document.getElementById('paymentModal').classList.remove('hidden');
        });
    
        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('paymentModal').classList.add('hidden');
        });
        document.getElementById('paybutton').addEventListener('click', () => {
            document.getElementById('bidForm').submit();
        });
    </script>
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