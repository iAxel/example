<?php

namespace App\Models\Auth\Gate;

use Illuminate\Contracts\Auth\Access\Gate;

trait Authorizable
{
    /**
     * @param iterable|string $abilities
     * @param array|mixed $arguments
     *
     * @return bool
     */
    public function can($abilities, $arguments = []): bool
    {
        return app(Gate::class)->forUser($this)->check($abilities, $arguments);
    }

    /**
     * @param iterable|string $abilities
     * @param array|mixed $arguments
     *
     * @return bool
     */
    public function canAny(iterable|string $abilities, mixed $arguments = []): bool
    {
        return app(Gate::class)->forUser($this)->any($abilities, $arguments);
    }

    /**
     * @param iterable|string $abilities
     * @param array|mixed $arguments
     *
     * @return bool
     */
    public function cant(iterable|string $abilities, mixed $arguments = []): bool
    {
        return $this->can($abilities, $arguments) !== true;
    }

    /**
     * @param iterable|string $abilities
     * @param array|mixed $arguments
     *
     * @return bool
     */
    public function cannot(iterable|string $abilities, mixed $arguments = []): bool
    {
        return $this->cant($abilities, $arguments);
    }
}
