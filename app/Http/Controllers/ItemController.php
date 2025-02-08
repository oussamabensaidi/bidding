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
            'item_pic' => 'nullable|array|max:6',
            'item_pic.*' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);


        






        if ($request->hasFile('item_pic')) {
            $fullName = [];
            $files = $request->file('item_pic');
        
            if (!is_array($files)) {
                $files = [$files]; // Convert single file to an array
            }
        
            foreach ($files as $file) {
                $fileName = auth()->id() . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('items_pic', $fileName, 'public');
                $fullName[] = $filePath;
            }
        
            $validated['item_pic'] = implode("|", $fullName);
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
            'item_pic' => 'nullable|array|max:6',
            'item_pic.*' => 'nullable|image|mimes:jpeg,png,jpg,gif'
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
    public function deleteImage(Item $item, Request $request)
{
    // $this->authorize('delete', $item);

    $itemName = $request->input('item_name');
    Storage::delete(str_replace('storage/', 'public/', $itemName));
    
    $pictures = $item->item_pic; 
    
    
    $pictures = array_filter($pictures, fn($pic) => $pic !== $itemName);

    
    $item->item_pic = array_values($pictures); // this function reindex the array so there is no gap if the delted image in middle or start of array
    $item->save();

    return redirect()->route('items.edit', $item)->with('success', 'Image deleted successfully.');
}

}