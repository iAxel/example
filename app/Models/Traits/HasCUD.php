<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasCUD
{
    /**
     * @param array $attributes
     *
     * @return Model|bool
     */
    public function exCreate(array $attributes): Model|bool
    {
        $model = $this->newInstance($attributes);

        if ($model->save() === false) {
            return false;
        }

        return $model;
    }

    /**
     * @param int $modelId
     * @param array $attributes
     *
     * @return Model|bool|null
     */
    public function exUpdate(int $modelId, array $attributes): Model|bool|null
    {
        $model = $this->findById($modelId);

        if ($model === null) {
            return null;
        }

        $model->fill($attributes);

        if ($model->save() === false) {
            return false;
        }

        return $model;
    }

    /**
     * @param int $modelId
     *
     * @return bool|null
     */
    public function exDelete(int $modelId): bool|null
    {
        $model = $this->findById($modelId);

        if ($model === null) {
            return null;
        }

        return $model->delete();
    }
}
