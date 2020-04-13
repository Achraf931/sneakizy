<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public function sneakers()
    {
        return $this->hasMany(Sneaker::class);
    }
}
