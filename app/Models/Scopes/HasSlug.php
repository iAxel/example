<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait HasSlug
{
    /**
     * @param Builder $query
     * @param string $slug
     *
     * @return Builder
     */
    public function scopeFindBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', '=', $slug);
    }
}
