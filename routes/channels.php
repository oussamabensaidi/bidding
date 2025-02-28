<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('bids', function () {
    // return (int) $user->id === (int) $id;
    return true;
});