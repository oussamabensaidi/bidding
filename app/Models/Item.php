<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'starting_bid',
        'end_time',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function bids() {
        return $this->hasMany(Bid::class);
    }
}
