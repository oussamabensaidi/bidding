<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('bids.{itemId}', function ($user, $itemId) {
    return true; 
});