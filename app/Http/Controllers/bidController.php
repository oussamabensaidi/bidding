<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
class bidController extends Controller
{
    public function bid(Item $item)
{
    return view('items.bid', compact('item'));
}
}
