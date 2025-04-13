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

    $items_count = Item::count();
    $live_count = Item::where('start_time', '<=', now())
                      ->where('end_time', '>', now())
                      ->count();

    $not_started_count = Item::where('start_time', '>', now())
                             ->count();

    $ended_count = Item::where('end_time', '<=', now())
                       ->count();
    $featuredItems = Item::latest()  
    ->take(3)   
    ->get();
    return view('dashboard', compact('items_count', 'live_count', 'not_started_count', 'ended_count','featuredItems'));
}
}
