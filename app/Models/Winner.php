<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
        'item_id',
        'user_id',
        'final_bid',
    ];
}
