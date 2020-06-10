<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'image', 'author', 'summary', 'content', 'is_published'];
    public function scopeIsPublished($query) {
        return $query->where('is_published', 1);
    }
}
