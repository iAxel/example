<?php

namespace App\Http\Repositories\Api\Policy;

use App\Models\Policy;

final class Repository
{
    /**
     * @var Policy
     */
    protected Policy $model;

    /**
     * @param Policy $model
     *
     * @return void
     */
    public function __construct(Policy $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function getModels(array $attributes): array
    {
        $models = $this->model->filter($attributes)->get();

        $result = $models->map(function (Policy $model) {
            return $this->getModel($model);
        });

        return $result->all();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function showModel(int $id): array
    {
        $model = $this->model->findById($id)->firstOrFail();

        return $this->getModel($model);
    }

    /**
     * @param Policy $model
     *
     * @return array
     */
    private function getModel(Policy $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'created_at' => $model->created_at,
        ];
    }
}
