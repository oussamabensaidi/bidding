<x-app-layout>
<div class="container mx-auto p-4">
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
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 m-4 transition-colors duration-200">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button id="next-btn" 
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 m-4 transition-colors duration-200">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        
        <!-- Auction Details -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold">Auction Details</h2>
            <p><strong>Starting price:</strong> ${{ $item->starting_bid }}</p>
            <p><strong>Current price:</strong> ${{ $item->current_bid }}</p>
            <p><strong>People Live:</strong> {{ $item->people_live }}</p>
            <p><strong>Comments:</strong></p>
            {{-- <ul>
                @foreach ($item->comments as $comment)
                    <li>{{ $comment->comment }}</li>
                @endforeach --}}
            <p><strong>Bid Right Now:</strong></p>
            {{-- <form action="{{ route('item.update', $item->id) }}" method="POST"> --}}
                @csrf
                <input type="number" name="bid_amount" class="border rounded p-2" placeholder="Enter your bid">
                <button type="button" class="bg-blue-500 text-white rounded p-2" onclick="document.getElementById('paymentModal').classList.remove('hidden')">Place Bid</button>
            {{-- </form> --}}
        </div>
    
        <div id="paymentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <div class="flex justify-between items-center border-b pb-2">
                    <h5 class="text-lg font-semibold">Choose Payment Method</h5>
                    <button class="text-gray-500" onclick="document.getElementById('paymentModal').classList.add('hidden')">&times;</button>
                </div>
                <div class="mt-4">
                    <button class="bg-blue-500 text-white w-full py-2 rounded mb-2">Pay with PayPal</button>
                    <hr class="my-4">
                    <form>
                        <div class="mb-3">
                            <label class="block text-sm font-medium">Card Number</label>
                            <input type="text" class="w-full p-2 border rounded mt-1" placeholder="1234 5678 9012 3456">
                        </div>
                        <div class="flex space-x-2">
                            <input type="text" class="w-1/2 p-2 border rounded" placeholder="MM/YY">
                            <input type="text" class="w-1/2 p-2 border rounded" placeholder="CVV">
                        </div>
                        <button type="submit" class="bg-green-500 text-white w-full py-2 rounded mt-4">Pay with Card</button>
                    </form>
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

    // Optional: Add keyboard navigation
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