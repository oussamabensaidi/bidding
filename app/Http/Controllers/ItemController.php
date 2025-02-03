<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('user_id', auth()->id())->latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_bid' => 'required|numeric|min:0',
            'end_time' => 'required|date',
            'item_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('item_pic')) {
            $path = $request->file('item_pic')->store('public/items');
            $validated['item_pic'] = str_replace('public/', 'storage/', $path);
        }

        $validated['user_id'] = auth()->id();
        $validated['current_bid'] = $validated['starting_bid'];
        // Set default statuses
        $validated['status'] = 'active';
        $validated['shipping_status'] = 'pending';

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        $this->authorize('view', $item);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_bid' => 'required|numeric|min:0',
            'end_time' => 'required|date',
            'status' => 'required|in:active,sold,expired',
            'shipping_status' => 'required|in:pending,shipped,delivered',
            'item_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('item_pic')) {
            // Delete old image
            if ($item->item_pic) {
                Storage::delete(str_replace('storage/', 'public/', $item->item_pic));
            }
            
            $path = $request->file('item_pic')->store('public/items');
            $validated['item_pic'] = str_replace('public/', 'storage/', $path);
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        if ($item->item_pic) {
            Storage::delete(str_replace('storage/', 'public/', $item->item_pic));
        }
        
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}