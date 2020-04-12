<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function sneaker(){
        return $this->belongsTo(Sneaker::class,'sneaker_id');
    }
}
