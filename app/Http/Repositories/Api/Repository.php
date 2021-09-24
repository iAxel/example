<?php

namespace App\Http\Repositories\Api;

abstract class Repository
{
    /**
     * @param array $attributes
     *
     * @return array
     */
    abstract public function getModels(array $attributes): array;

    /**
     * @param array $attributes
     *
     * @return array|bool
     */
    abstract public function createModel(array $attributes): array|null;

    /**
     * @param int $id
     *
     * @return array
     */
    abstract public function showModel(int $id): array;

    /**
     * @param int $id
     * @param array $attributes
     *
     * @return array|null
     */
    abstract public function updateModel(int $id, array $attributes): array|null;

    /**
     * @param int $id
     *
     * @return bool
     */
    abstract public function deleteModel(int $id): bool;
}
