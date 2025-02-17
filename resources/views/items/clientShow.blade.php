<x-app-layout>
<!-- blade.php file -->
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
                 class="w-full h-96 object-cover rounded-lg shadow-lg transition-opacity duration-300">
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
    </div>
</div>

<script>
    // Get elements from DOM
    const currentImage = document.getElementById('current-image');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    // Image array - replace with your Laravel image paths
    const images = @json($item->item_pic); // Pass images array from controller
    let currentIndex = 0;

    // Function to update image
    function updateImage(index) {
        currentImage.src = "{{ asset('') }}" + images[index];
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