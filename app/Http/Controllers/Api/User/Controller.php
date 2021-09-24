<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Response;

use App\Http\Requests\Api\User\ShowRequest;
use App\Http\Requests\Api\User\IndexRequest;
use App\Http\Requests\Api\User\CreateRequest;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Http\Requests\Api\User\DeleteRequest;

use App\Http\Repositories\Api\User\Repository;

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
            return $this->response->sendConflict(['message' => 'Unable to create user.']);
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
            return $this->response->sendConflict(['message' => 'Unable to update user.']);
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
            return $this->response->sendConflict(['message' => 'Unable to delete user.']);
        }

        return $this->response->sendOK(['message' => 'User deleted successfully.']);
    }
}
