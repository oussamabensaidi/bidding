<!-- resources/views/items/create.blade.php -->
<x-app-layout>
<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label>Description</label>
        <textarea name="description" required>{{ old('description') }}</textarea>
    </div>
    <div>
        <label>Starting Bid</label>
        <input type="number" step="0.01" name="starting_bid" value="{{ old('starting_bid') }}" required>
    </div>
    <div>
        <label>End Time</label>
        <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required>
    </div>
    {{-- <div>
        <label>Shipping Status</label>
        <select name="shipping_status" required>
            <option value="pending">Pending</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
        </select>
    </div> --}}
    <div>
        <label>Item Image</label>
        <input type="file" name="item_pic">
    </div>
    <button type="submit">Create Item</button>
</form>
</x-app-layout>