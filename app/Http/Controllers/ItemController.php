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
        if (auth()->user()->role == 'client') {
            $items = Item::paginate(10);// Show all items to the clients 
        }
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $this->authorize('create', Item::class); // Check if the user is authorized to create an item
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
            'item_pic.*' => 'nullable|image|mimes:jpeg,png,jpg,gif' // .* is used to validate each item in the array of item pics
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
        'name'         => 'required|string|max:255',
        'description'  => 'required|string',
        'starting_bid' => 'required|numeric|min:0',
        'end_time'     => 'required|date',
        'item_pic'     => 'nullable|array|max:6',
        'item_pic.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif'
    ]);

    if ($request->hasFile('item_pic')) {
        $paths = [];
        // Ensure $files is always an array
        $files = $request->file('item_pic');
        if (!is_array($files)) {
            $files = [$files];
        }
        foreach ($files as $file) {
            if ($file) {  // Skip null entries if any
                $fileName = auth()->id() . '_' . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $paths[] = $file->storeAs('items_pic', $fileName, 'public');
            }
        }
        // Save file paths as a pipe-separated string
        $validated['item_pic'] = implode("|", $paths);
    }

    $item->update($validated);

    return redirect()->route('items.index')->with('success', 'Item updated successfully.');
}

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $pictures = explode('|', $item->item_pic);
        if ($item->item_pic) {
            foreach($pictures as $pic) {
                Storage::disk('public')->delete($pic);
            }
        }
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
    public function deleteImage(Item $item, Request $request)
    {
        $this->authorize('delete', $item);
        $request->validate(['item_name' => 'required|string']);
        $itemName = $request->input('item_name');
        $oldPictures = explode('|', $item->item_pic);
        // Remove the image from the array
        $pictures = array_filter($oldPictures, fn($pic) => $pic !== $itemName);
        // Only delete the file if it was originally part of the item
        if (in_array($itemName, $oldPictures)) {
            Storage::disk('public')->delete($itemName);
        }
        // Update the item's pictures
        $item->item_pic = implode('|', $pictures);
        $item->save();
        // return dd($item, $pictures, $oldPictures, $itemName);
        return redirect()->route('items.show', $item)->with('success', 'Image deleted successfully.');
    }

}