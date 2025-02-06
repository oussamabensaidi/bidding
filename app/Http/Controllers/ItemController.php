<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Policies\ItemPolicy;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; //
class ItemController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $items = Item::where('user_id', auth()->user()->id)->paginate(10);
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
            'item_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:11000'
        ]);

        // if ($request->hasFile('item_pic')) {
        //     $path = $request->file('item_pic')->store('public/items');
        //     $validated['item_pic'] = str_replace('public/', 'storage/', $path);
        // }

        if ($request->hasFile('item_pic')) {
            $file = $request->file('item_pic');
            $filePath = $file->storeAs('items_pic', auth()->user()->id.auth()->user()->name. '.' . $file->getClientOriginalExtension(), 'public');
            $validated['item_pic'] = $filePath;
        }
        $validated['user_id'] = auth()->user()->id;
        $validated['current_bid'] = $validated['starting_bid'];
        
        $validated['status'] = 1;
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
            'item_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('item_pic')) {
            if ($item->item_pic) {
                Storage::disk('public')->delete($item->item_pic);
                
            }
    
            // Store new profile picture
            $file = $request->file('item_pic');
            $filePath = $file->storeAs('items_pic',  auth()->user()->id.auth()->user()->name. '.' . $file->getClientOriginalExtension(), 'public');
            // $user->item_pic = $filePath;
            $validated['item_pic'] = $filePath;
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