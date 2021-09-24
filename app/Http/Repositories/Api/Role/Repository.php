<?php

namespace App\Http\Repositories\Api\Role;

use App\Models\Role;

use App\Http\Repositories\Api\Repository as BaseRepository;

final class Repository extends BaseRepository
{
    /**
     * @var Role
     */
    protected Role $model;

    /**
     * @param Role $model
     *
     * @return void
     */
    public function __construct(Role $model)
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

        $result = $models->map(function (Role $model) {
            return $this->getModel($model);
        });

        return $result->all();
    }

    /**
     * @param array $attributes
     *
     * @return array|null
     */
    public function createModel(array $attributes): array|null
    {
        $model = new Role($attributes);

        if ($model->save() === false) {
            return null;
        }

        return $this->getModel($model);
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
     * @param int $id
     * @param array $attributes
     *
     * @return array|null
     */
    public function updateModel(int $id, array $attributes): array|null
    {
        $model = $this->model->findById($id)->firstOrFail();

        $model->fill($attributes);

        if ($model->save() === false) {
            return null;
        }

        return $this->getModel($model);
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function deleteModel(int $id): bool
    {
        $model = $this->model->findById($id)->firstOrFail();

        return $model->delete();
    }

    /**
     * @param Role $user
     *
     * @return array
     */
    private function getModel(Role $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'slug' => $user->slug,
            'created_at' => $user->created_at,
        ];
    }
}
