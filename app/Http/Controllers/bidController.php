<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use App\Events\BidPlaced;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class bidController extends Controller
{
public function bid(Item $item){
    return view('items.bid', compact('item'));
}


public function updateBid(Request $request, Item $item){
    // $this->authorize('update', $item);

    $validated = $request->validate([
        'bid_amount' => [
    'required',
    'numeric',
    'min:' . (isset($item->current_bid) ? ($item->current_bid + 1) : ($item->starting_bid + 1)),
]
    ]);
    Bid::create([
        'user_id' => Auth::id(),
        'item_id' => $item->id,
        'amount' => $validated['bid_amount'],
    ]);

    $item->update(['current_bid' => $validated['bid_amount']]);
    broadcast(new BidPlaced($validated['bid_amount'], $item->id));



    // return redirect()->route('items.bid', ['item' => $item])->with('success', 'Bid updated successfully.');
    return response()->json(['message' => 'Bid placed successfully!']);
}
}
