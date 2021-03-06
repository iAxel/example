<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait HasId
{
    /**
     * @param Builder $query
     * @param int $id
     *
     * @return Builder
     */
    public function scopeFindById(Builder $query, int $id): Builder
    {
        return $query->where('id', '=', $id);
    }
}
