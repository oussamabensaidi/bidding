<x-app-layout>
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">All Items</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Create New Item
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Current Bid</th>
                    <th class="py-2 px-4 border-b">End Time</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="py-2 px-4 border-b">
                        @if($item->item_pic)
                            <img src="{{ asset($item->item_pic) }}" alt="{{ $item->name }}" class="w-20 h-20 object-cover">
                        @else
                            <span class="text-gray-500">No image</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">{{ $item->name }}</td>
                    <td class="py-2 px-4 border-b">${{ number_format($item->current_bid, 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->end_time->format('M d, Y H:i') }}</td>
                    <td class="py-2 px-4 border-b">
                        <span class="px-2 py-1 text-sm rounded-full 
                            @if($item->status === 'active') bg-green-200 text-green-800
                            @elseif($item->status === 'sold') bg-blue-200 text-blue-800
                            @else bg-gray-200 text-gray-800 @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                        <a href="{{ route('items.edit', $item) }}" class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" 
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
</div>
</x-app-layout>