<x-app-layout>
<div class="container mx-auto px-4">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Items') }}
            </h2>
            @can('create', App\Models\Item::class)
            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Total Users: {{ $userCount }}
            </h3>
            @endcan
        </div>
    </x-slot>
    <script>
startCountdown = function (startTime, endTime, elementId) {
  let countDownDate = new Date(startTime).getTime();
  let endDate = new Date(endTime).getTime();
  let timerElement = document.getElementById(elementId);
  
  let x = setInterval(() => {
      let now = new Date().getTime();
      
      if (now >= endDate) {
        timerElement.innerHTML = "Bidding Ended!";
        timerElement.className = "bg-red-500 text-white px-4 py-2 rounded-md text-lg font-semibold shadow-md text-center";
          clearInterval(x);
          return;
        }
        
        if (now >= countDownDate) {
          let timeLeft = Math.floor((endDate - now) / 1000);
          let minutesLeft = Math.floor(timeLeft / 60);
          let secondsLeft = timeLeft % 60;
          timerElement.innerHTML = "Bidding Started! Time left: " + minutesLeft + "m " + secondsLeft + "s";
          timerElement.className = "bg-green-500 text-white px-4 py-2 rounded-md text-lg font-semibold shadow-md text-center";
          return;
        }
        
        let distance = countDownDate - now;
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        timerElement.innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
        timerElement.className = "bg-yellow-500 text-white px-4 py-2 rounded-md text-lg font-semibold shadow-md text-center animate-pulse";
      }, 1000);
    }
</script>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @can('create', App\Models\Item::class)
        <a href="{{ route('items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 mb-4 inline-block">
            Create New Item
        </a>
    @endcan

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
                  class="w-38 h-full object-cover"
                >
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
                <p class="text-gray-600 dark:text-gray-300 mb-2">${{ number_format($item->current_bid, 2) }}</p>
              <h3 class="font-medium mb-2 line-clamp-2 text-gray-900 dark:text-gray-100">{{ $item->name }}</h3>
             
              @can('create', App\Models\Item::class)
    <button class="bg-green-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
        <a href="{{route('items.show',$item)}}">
        View Details</a>
    </button>
    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
        <a href="{{route('items.edit',$item)}}">
       Edit</a>
    </button>

@else
    <button class="bg-green-500 text-white px-4 py-2 rounded-md ">
         <a href="{{ route('captcha.show',$item) }}">Bed $$$</a>
    </button>
    {{-- <button class="bg-blue-500 text-white px-4 py-2 rounded-md ">
       <a href="{{route('items.clientShow',$item)}}">see item</a>
    </button> --}}

@endcan
            </div>
          </div>
        @endforeach
      </div>
    <div class="mt-4">
        {{ $items->links() }}
    </div>
    
  
</x-app-layout>