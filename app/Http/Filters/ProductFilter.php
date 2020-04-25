<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class ProductFilter extends Filter
{
    public function search(string $value = null): Builder
    {
        dd($value);
        return $this->builder->where('name', 'like', "{$value}%");
    }

/*    public function status(string $value = null): Builder
    {
        return $this->builder->where('status', $value);
    }

    public function category(string $value = null): Builder
    {
        return $this->builder->where('category', $value);
    }

    public function sort(array $value = []): Builder
    {
        if (isset($value['by']) && ! Schema::hasColumn('products', $value['by'])) {
            return $this->builder;
        }

        return $this->builder->orderBy(
            $value['by'] ?? 'created_at', $value['order'] ?? 'desc'
        );
    }*/
}
