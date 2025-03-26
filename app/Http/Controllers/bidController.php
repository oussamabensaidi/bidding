<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use App\Events\BidPlaced;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Carbon\Carbon;
class bidController extends Controller
{
public function bid(Item $item){
    return view('items.bid', compact('item'));
}


public function updateBid(Request $request, Item $item){
    // $this->authorize('update', $item);
    $startTime = Carbon::parse($item->start_time);
    $endTime = Carbon::parse($item->end_time);
    $now = now();
    if ($now->lt($startTime) || $now->gt($endTime)) {
        return redirect()->route('items.bid', ['item' => $item])->with('error', 'Bidding is not allowed at this time.');
    }
    $validated = $request->validate([
        'bid_amount' => [
    'required',
    'numeric',
    'min:' . (isset($item->current_bid) ? ($item->current_bid + 1) : ($item->starting_bid + 1)),
]
    ]);
    $userId = Auth::id();

    Bid::create([
        'user_id' => $userId,
        'item_id' => $item->id,
        'amount' => $validated['bid_amount'],
    ]);



    $item->update(['current_bid' => $validated['bid_amount']]);

        broadcast(new BidPlaced($validated['bid_amount'], $item->id, $userId));
    



        return redirect()->route('items.bid', ['item' => $item])->with('success', 'Bid updated successfully.');
}
}
