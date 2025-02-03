@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Edit Item</h1>

    <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <!-- Existing Image -->
            @if($item->item_pic)
                <div>
                    <label class="block text-gray-700 mb-2">Current Image:</label>
                    <img src="{{ asset($item->item_pic) }}" alt="Current Image" class="w-32 h-32 object-cover rounded">
                </div>
            @endif

            <!-- Image Upload -->
            <div>
                <label class="block text-gray-700 mb-2">New Image (optional):</label>
                <input type="file" name="item_pic" class="w-full p-2 border rounded">
                @error('item_pic')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div>
                <label class="block text-gray-700 mb-2">Item Name:</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" 
                    class="w-full p-2 border rounded" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-gray-700 mb-2">Description:</label>
                <textarea name="description" rows="4" 
                    class="w-full p-2 border rounded" required>{{ old('description', $item->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Starting Bid -->
            <div>
                <label class="block text-gray-700 mb-2">Starting Bid:</label>
                <input type="number" step="0.01" name="starting_bid" 
                    value="{{ old('starting_bid', $item->starting_bid) }}" 
                    class="w-full p-2 border rounded" required>
                @error('starting_bid')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Time -->
            <div>
                <label class="block text-gray-700 mb-2">End Time:</label>
                <input type="datetime-local" name="end_time" 
                    value="{{ old('end_time', $item->end_time->format('Y-m-d\TH:i')) }}" 
                    class="w-full p-2 border rounded" required>
                @error('end_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-gray-700 mb-2">Status:</label>
                <select name="status" class="w-full p-2 border rounded" required>
                    <option value="active" {{ old('status', $item->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="sold" {{ old('status', $item->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="expired" {{ old('status', $item->status) === 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Shipping Status -->
            <div>
                <label class="block text-gray-700 mb-2">Shipping Status:</label>
                <select name="shipping_status" class="w-full p-2 border rounded" required>
                    <option value="pending" {{ old('shipping_status', $item->shipping_status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="shipped" {{ old('shipping_status', $item->shipping_status) === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ old('shipping_status', $item->shipping_status) === 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                @error('shipping_status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Item
                </button>
                <a href="{{ route('items.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>
@endsection