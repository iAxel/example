<?php

namespace App\Http\Controllers\Api\Policy;

use App\Helpers\Response;

use App\Http\Requests\Api\Policy\ShowRequest;
use App\Http\Requests\Api\Policy\IndexRequest;

use App\Http\Repositories\Api\Policy\Repository;

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
}
