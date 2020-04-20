<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $casts = ['quantity', 'size'];
    public function sneakers()
    {
        return $this->belongsTo(Sneaker::class);
    }
}
