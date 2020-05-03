<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function scopeIsPublished($query) {
        return $query->where('is_published', 1);
    }
}
