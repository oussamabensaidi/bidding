<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('bids.{itemId}', function () {
    return true; 
});