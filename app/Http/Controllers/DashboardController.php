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
        $items_count = Item::where('user_id', Auth::id())->count();
        return view('dashboard', compact('items_count'));
    }
}
