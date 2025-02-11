<x-app-layout>
<div class="container mx-auto px-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Items') }}
        </h2>
    </x-slot>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @can('create', $items)
        <a href="{{ route('items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 mb-4 inline-block">
            Create New Item
        </a>
    @endcan
   

    <div class="overflow-x-auto mt-4 mb-4 inline-block w-full">
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">Image</th>
                    <th class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">Name</th>
                    <th class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">Current Bid</th>
                    <th class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">End Time</th>
                    <th class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">Status</th>
                    <th class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="bg-white dark:bg-gray-700">
                    <td class="py-2 px-4 border-b dark:border-gray-600">
                        @php
                            $pics = is_string($item->item_pic) ? explode('|', $item->item_pic) : [];
                        @endphp
                        @if (!empty($pics))
                            <img src="{{ Storage::url($pics[0]) }}" alt="{{ $item->name }}" class="w-20 h-20 object-cover">
                        @else
                            <span class="text-gray-500 dark:text-gray-300">No image</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">{{ $item->name }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">${{ number_format($item->current_bid, 2) }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-600 text-gray-900 dark:text-gray-100">{{ $item->end_time->format('M d, Y H:i') }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-600">
                        <span class="px-2 py-1 text-sm rounded-full 
                            @if($item->status === 'active')
                                bg-green-200 text-green-800 dark:bg-green-600 dark:text-green-200
                            @elseif($item->status === 'sold')
                                bg-blue-200 text-blue-800 dark:bg-blue-600 dark:text-blue-200
                            @else
                                bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200
                            @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b dark:border-gray-600">
                        <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</a>
                        <a href="{{ route('items.edit', $item) }}" class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 mr-2">Edit</a>
                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                                onclick="return confirm('Are you sure you want to delete this item?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $items->links() }}
    </div>
    
</x-app-layout>