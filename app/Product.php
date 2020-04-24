<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'color', 'release_date', 'image', 'brand', 'is_published', 'brand_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeIsPublished($query) {
        return $query->where('is_published', 1);
    }
}
