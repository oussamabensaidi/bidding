<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 dark:text-gray-100">
                @php
                    $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
                @endphp 

                <div class="grid grid-cols-3 gap-4 mb-4">
                    @if (!empty($pics))
                        @foreach ($pics as $pic)
                            <div class="max-w-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm m-4 relative">
                                <a href="{{ Storage::url($pic) }}" target="_blank">
                                    <img src="{{ Storage::url($pic) }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded-t-lg">
                                </a>
                                <span class="absolute top-0 right-0">
                                    <form action="{{ route('items.delete-image', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="item_name" value="{{ $pic }}"> 
                                        <button class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-500 text-white p-2 rounded" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA3323">
                                                <path d="M280-440h400v-80H280v80ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        @endforeach
                    @else
                        <span class="text-gray-500 dark:text-gray-300">No image</span>
                    @endif
                </div>

                <h1 class="text-2xl font-bold mb-4 dark:text-gray-100">{{ $item->name }}</h1>
                <p class="text-gray-600 mb-4 dark:text-gray-300">{{ $item->description }}</p>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="font-semibold dark:text-gray-100">Starting Bid:</p>
                        <p class="dark:text-gray-200">${{ number_format($item->starting_bid, 2) }}</p>
                    </div>
                    <div>
                        <p class="font-semibold dark:text-gray-100">Current Bid:</p>
                        <p class="dark:text-gray-200">${{ number_format($item->current_bid, 2) }}</p>
                    </div>
                    <div>
                        <p class="font-semibold dark:text-gray-100">End Time:</p>
                        <p class="dark:text-gray-200">{{ $item->end_time->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="font-semibold dark:text-gray-100">Status:</p>
                        <p class="capitalize dark:text-gray-200">{{ $item->status }}</p>
                    </div>
                    <div>
                        <p class="font-semibold dark:text-gray-100">Shipping Status:</p>
                        <p class="capitalize dark:text-gray-200">{{ $item->shipping_status }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                        ← Back to Items
                    </a>
                    <div class="space-x-2">
                        <a href="{{ route('items.edit', $item) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Edit Item
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
