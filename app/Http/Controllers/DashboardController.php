<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard()
{
    $userId = Auth::id();

    $items_count = Item::where('user_id', $userId)->count();
    $live_count = Item::where('user_id', $userId)
                      ->where('start_time', '<=', now())
                      ->where('end_time', '>', now())
                      ->count();

    $not_started_count = Item::where('user_id', $userId)
                             ->where('start_time', '>', now())
                             ->count();

    $ended_count = Item::where('user_id', $userId)
                       ->where('end_time', '<=', now())
                       ->count();
    $featuredItems = Item::where('user_id', $userId)
    ->latest()  // Sort by the most recent
    ->take(3)   // Limit to 3 items
    ->get();
    return view('dashboard', compact('items_count', 'live_count', 'not_started_count', 'ended_count','featuredItems'));
}
}
