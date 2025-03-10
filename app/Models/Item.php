<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'starting_bid',
        'current_bid',
        'end_time',
        'status',
        'shipping_status',
        'item_pic'
    ];
    protected $casts = [
        'end_time' => 'datetime',
        'starting_bid' => 'decimal:2',
        'current_bid' => 'decimal:2',
    ]; // this is for better security ;)
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function bids() {
        return $this->hasMany(Bid::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
