<?php

namespace App\Http\Controllers\Api\Role;

use App\Helpers\Response;

use App\Http\Requests\Api\Role\ShowRequest;
use App\Http\Requests\Api\Role\IndexRequest;
use App\Http\Requests\Api\Role\CreateRequest;
use App\Http\Requests\Api\Role\UpdateRequest;
use App\Http\Requests\Api\Role\DeleteRequest;

use App\Http\Repositories\Api\Role\Repository;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller as BaseController;

final class Controller extends BaseController
{
    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var Repository
     */
    protected Repository $repository;

    /**
     * @param Response $response
     * @param Repository $repository
     *
     * @return void
     */
    public function __construct(Response $response, Repository $repository)
    {
        $this->response = $response;

        $this->repository = $repository;
    }

    /**
     * @param IndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $attributes = $request->getAttributes();

        $models = $this->repository->getModels($attributes);

        return $this->response->sendOK($models);
    }

    /**
     * @param CreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $attributes = $request->getAttributes();

        $model = $this->repository->createModel($attributes);

        if ($model === null) {
            return $this->response->sendConflict(['message' => 'Unable to create role.']);
        }

        return $this->response->sendCreated($model);
    }

    /**
     * @param ShowRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(ShowRequest $request, int $id): JsonResponse
    {
        $model = $this->repository->showModel($id);

        return $this->response->sendOK($model);
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $attributes = $request->getAttributes();

        $model = $this->repository->updateModel($id, $attributes);

        if ($model === null) {
            return $this->response->sendConflict(['message' => 'Unable to update role.']);
        }

        return $this->response->sendOK($model);
    }

    /**
     * @param DeleteRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, int $id): JsonResponse
    {
        $deleted = $this->repository->deleteModel($id);

        if ($deleted === false) {
            return $this->response->sendConflict(['message' => 'Unable to delete role.']);
        }

        return $this->response->sendOK(['message' => 'Role deleted successfully.']);
    }
}
