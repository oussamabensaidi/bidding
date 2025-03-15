<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('bids.{itemId}', function () {
    return true;
});
Broadcast::channel('comment.{itemId}', function () {
    // return (bool) $user; 
    return true;
});