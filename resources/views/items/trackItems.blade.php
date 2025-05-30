<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4 ">
    @foreach ($items as $item)
    @php
        $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
    @endphp
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow border border-purple-300 dark:border-purple-700 shadow-lg" >
        {{-- Image Container with Fixed Size --}}
        <div class="relative w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
          @if (!empty($pics))
            <img 
              src="{{ Storage::url($pics[0]) }}"
              alt="{{ $item->name }}"
              class="w-38 h-full object-cover">
          @else
            <span class="text-gray-500 dark:text-gray-300">No image</span>
          @endif
        </div>
  
        {{-- Content Section --}}
        <div id="timer-{{ $item->id }}"></div>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            // Use Blade syntax to embed PHP variables into the JavaScript
            let bidStartTime = "{{ $item->start_time }}";
            let bidEndTime = "{{ $item->end_time }}";
            
            // Make sure the element ID is dynamically set as well
            startCountdown(bidStartTime, bidEndTime, 'timer-{{ $item->id }}');
          });
        </script>
      
        <div class="p-4 text-center">
            <p class="text-gray-500 dark:text-gray-300 mb-2"><span class="text-red-600">${{ number_format($item->current_bid, 2) }}</span> => <span class="text-green-600">${{number_format($item->starting_bid, 2)}}</span></p>
          <h3 class="font-medium mb-2 line-clamp-2 text-gray-900 dark:text-gray-100">{{ $item->name }}</h3>
         
        @can('isAdmin', App\Models\Item::class)
<div class="flex justify-center space-x-2 mt-2">
  <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
    <a href="{{route('trackItemsHistory',$item)}}">See History</a>
  </button>
  <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition-colors">
    <a href="{{route('trackItemsUpdateState',$item)}}">Update Deleviry</a>
  </button>
</div>
@else
@endcan
        </div>
      </div>
    @endforeach
</x-app-layout>