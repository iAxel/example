<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait HasIdentifier
{
    /**
     * @param Builder $query
     * @param string $identifier
     * @param mixed $value
     *
     * @return Builder
     */
    public function scopeFindByIdentifier(Builder $query, string $identifier, mixed $value): Builder
    {
        return $query->where($identifier, '=', $value);
    }
}
