<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Response;

use Illuminate\Http\JsonResponse;

use App\Http\Requests\Api\Request;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @param Response $response
     *
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    abstract public function index(Request $request): JsonResponse;

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    abstract public function create(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    abstract public function show(Request $request, int $id): JsonResponse;

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    abstract public function update(Request $request, int $id): JsonResponse;

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    abstract public function delete(Request $request, int $id): JsonResponse;
}
