<?php

namespace App\Models\Scopes;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Contracts\Support\Arrayable;

trait HasCredentials
{
    /**
     * @param Builder $query
     * @param array $credentials
     *
     * @return Builder
     */
    public function scopeFindByCredentials(Builder $query, array $credentials): Builder
    {
        foreach ($credentials as $key => $value) {
            $hasPassword = Str::contains($key, 'password');

            if ($hasPassword === true) {
                continue;
            }

            $isArray = is_array($value);

            if ($isArray === true || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, '=', $value);
            }
        }

        return $query;
    }
}
