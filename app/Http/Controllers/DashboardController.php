<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use Carbon\Carbon;
use COM;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard()
{
    $userId = Auth::id();
    $now = now()->timezone('Africa/Casablanca');

    $items_count = Item::where('user_id', Auth::id())->count();
    $live_count = Item::where('user_id', Auth::id())
                  ->where('start_time', '<=', $now)
                  ->where('end_time', '>', $now)
                  ->count();

$not_started_count = Item::where('user_id', Auth::id())
                         ->where('start_time', '>', $now)
                         ->count();

$ended_count = Item::where('user_id', Auth::id())
                   ->where('end_time', '<=', $now)
                   ->count();

$featuredItems = Item::where('user_id', Auth::id())
                     ->latest()
                     ->take(3)
                     ->get();

if (Auth::check() && Auth::user()->role == 'client') {
    $items_count = Item::all()->count();
    $live_count = Item::all()
                  ->where('start_time', '<=', $now)
                  ->where('end_time', '>', $now)
                  ->count();

$not_started_count = Item::all()
                         ->where('start_time', '>', $now)
                         ->count();

$ended_count = Item::all()
                   ->where('end_time', '<=', $now)
                   ->count();

$featuredItems = Item::latest()
                     ->take(3)
                     ->get();
}

return view('dashboard', compact('items_count', 'live_count', 'not_started_count', 'ended_count', 'featuredItems'));

}
public function advanceSearch()
{
    $items = Item::all();
    return view('advanceSearch',compact('items'));
}
public function items_search(Request $request)
{
    $query = Item::query();

    // Search by name
    if ($request->has('search') && $request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
    }

    // Sort by latest
    if ($request->has('latest')) {
        $query->latest();
    }

    // Price sorting
    if ($request->has('price')) {
        switch ($request->input('price')) {
            case 'expensive':
                $query->orderBy('starting_bid', 'desc');
                break;
            case 'cheapest':
                $query->orderBy('starting_bid', 'asc');
                break;
        }
    }

    // Status filter
  if ($request->has('statu')) {
    $now = Carbon::now();
    
    switch ($request->input('statu')) {
        case 'soon':
            $query->where('start_time', '>', $now);
            break;
            
        case 'live':
            $query->where('start_time', '<=', $now)
                  ->where('end_time', '>=', $now);
            break;
            
        case 'ended':
            $query->where('end_time', '<', $now);
            break;
    }
}


    $items = $query->get(); 

    return view('advanceSearch', compact('items'));
}

}
