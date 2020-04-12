<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function sneaker()
    {
        return $this->belongsTo(Sneaker::class);
    }
}
