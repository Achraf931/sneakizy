<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    protected $fillable = ['name', 'description', 'price', 'color', 'release_date', 'image', 'stock', 'is_published', 'brand_id'];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
