<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Events\placeComment;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class CommentController extends Controller
{
    public function comment(){
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->item_id = request('item_id');
        $comment->comment = request('comment');
        $comment->save();
        broadcast(new placeComment(request('comment'), request('item_id'), Auth::id()));
        return redirect()->route('items.bid', ['item' => request('item_id')]);
    }
}
