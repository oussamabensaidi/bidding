<x-app-layout>
<div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
    <div class="relative max-w-2xl mx-auto">
        <!-- Image Container -->
        @php
            $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
        @endphp 
        <div class="relative">
            <img id="current-image" 
                 src="{{ Storage::url($pics[0]) }}" 
                 alt="Gallery image" 
                 class="w-full h-80 object-cover rounded-lg shadow-lg transition-opacity duration-300">
        </div>

        <!-- Navigation Buttons -->
        <button id="prev-btn" 
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-full p-2 m-4 transition-colors duration-200">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button id="next-btn" 
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-full p-2 m-4 transition-colors duration-200">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        
        <!-- Auction Details -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold">Auction Details</h2>
            <p><strong>Starting price:</strong> ${{ $item->starting_bid }}</p>
            <p id="current-bid-amount"><strong>Current price:</strong> ${{ $item->current_bid }}</p>
            <p><strong>People Live:</strong> {{ $item->people_live }}</p>
            <p><strong>Comments:</strong></p>
            
                <form action="{{ route('items.updateBid', $item->id) }}" method="POST" id="bidForm">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="bid_amount" class="border rounded p-2 dark:bg-gray-800 dark:border-gray-600" placeholder="Enter your bid">
                    <button type="button" class="bg-blue-500 text-white rounded p-2" id="openModal">Place Bid</button>
                </form>
                
                <!-- Tooltip -->
                
                <!-- Payment Modal -->
                <div id="paymentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                        <div class="flex justify-between items-center border-b pb-2 dark:border-gray-600">
                            <h5 class="text-lg font-semibold">Choose Payment Method</h5>
                            <button class="text-gray-500 dark:text-gray-400" id="closeModal">&times;</button>
                        </div>
                        <div class="mt-4">
                            <button class="bg-blue-500 text-white w-full py-2 rounded mb-2">Pay with PayPal</button>
                            <hr class="my-4 dark:border-gray-600">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium">Card Number</label>
                                    <input type="text" class="w-full p-2 border rounded mt-1 dark:bg-gray-700 dark:border-gray-600" placeholder="1234 5678 9012 3456" disabled>
                                </div>
                                <div class="flex space-x-2">
                                    <input type="text" class="w-1/2 p-2 border rounded dark:bg-gray-700 dark:border-gray-600" placeholder="MM/YY" disabled>
                                    <input type="text" class="w-1/2 p-2 border rounded dark:bg-gray-700 dark:border-gray-600" placeholder="CVV" disabled>
                                    <div class="relative group">
                                        <button class="bg-gray-200 dark:bg-gray-700 p-2 rounded">?</button>
                                        <span class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 hidden group-hover:block bg-black text-white text-xs px-3 py-1 rounded">
                                            this is a showcase project, no real payment is processed
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="bg-green-500 text-white w-full py-2 rounded mt-4" id="paybutton">Pay with Card</button>
                            
                        </div>
                    </div>
                    <input type="hidden" name="item_id" value="{{ $item->id }}" id="item_id">
                </div>
                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function () {
                            const itemId = {{ $item->id }};
                            Echo.channel(`bids.${itemId}`)
                                .listen('.BidPlaced', (e) => {
                                    console.log('New bid:', e.bidAmount, 'on item:', e.itemId);
                                    alert('New bid placed!');
                                    });
});


                </script> --}}




                <!-- JavaScript for Modal -->
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

<style>
    /* Optional custom CSS for fade animation */
    #current-image {
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }
    
    #current-image.fade {
        opacity: 0;
    }
</style>
    
</x-app-layout>