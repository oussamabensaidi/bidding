@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            @if($item->item_pic)
                <img src="{{ asset($item->item_pic) }}" alt="{{ $item->name }}" class="w-full h-64 object-cover mb-4 rounded">
            @endif
            
            <h1 class="text-2xl font-bold mb-4">{{ $item->name }}</h1>
            <p class="text-gray-600 mb-4">{{ $item->description }}</p>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="font-semibold">Starting Bid:</p>
                    <p>${{ number_format($item->starting_bid, 2) }}</p>
                </div>
                <div>
                    <p class="font-semibold">Current Bid:</p>
                    <p>${{ number_format($item->current_bid, 2) }}</p>
                </div>
                <div>
                    <p class="font-semibold">End Time:</p>
                    <p>{{ $item->end_time->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <p class="font-semibold">Status:</p>
                    <p class="capitalize">{{ $item->status }}</p>
                </div>
                <div>
                    <p class="font-semibold">Shipping Status:</p>
                    <p class="capitalize">{{ $item->shipping_status }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800">
                    ← Back to Items
                </a>
                <div class="space-x-2">
                    <a href="{{ route('items.edit', $item) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Edit Item
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection