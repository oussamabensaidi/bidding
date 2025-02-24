<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
class bidController extends Controller
{
    public function bid(Item $item)
{
    return view('items.bid', compact('item'));
}


public function updateBid(Request $request, Item $item)
{
    // $this->authorize('update', $item);

    $validated = $request->validate([
        'bid_amount' => [
    'required',
    'numeric',
    'min:' . (isset($item->current_bid) ? ($item->current_bid + 1) : ($item->starting_bid + 1)),
]
    ]);

    $item->update(['current_bid' => $validated['bid_amount']]);

    return redirect()->route('items.bid', ['item' => $item])->with('success', 'Bid updated successfully.');
}
}
