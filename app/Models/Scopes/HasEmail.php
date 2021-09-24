<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait HasEmail
{
    /**
     * @param Builder $query
     * @param string $email
     *
     * @return Builder
     */
    public function scopeFindByEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', '=', $email);
    }
}
