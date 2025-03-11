<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function comment(){
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->item_id = request('item_id');
        $comment->comment = request('comment');
        $comment->save();
        return redirect()->route('items.bid', ['item' => request('item_id')]);
    }
}
