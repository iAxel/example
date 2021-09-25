<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\Response;

use App\Http\Requests\Api\Profile\Request;

use App\Http\Repositories\Api\Profile\Repository;

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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();

        $profile = $this->repository->showProfile($user);

        return $this->response->sendOK($profile);
    }
}
