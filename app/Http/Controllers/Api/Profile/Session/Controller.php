<?php

namespace App\Http\Controllers\Api\Profile\Session;

use App\Helpers\Response;

use App\Http\Requests\Api\Profile\Session\IndexRequest;
use App\Http\Requests\Api\Profile\Session\RevokeRequest;
use App\Http\Requests\Api\Profile\Session\RevokeAllRequest;

use App\Http\Repositories\Api\Profile\Session\Repository;

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
        $token = $request->getToken();

        $sessions = $this->repository->getSessions($token);

        return $this->response->sendOK($sessions);
    }

    /**
     * @param RevokeRequest $request
     * @param string $token
     *
     * @return JsonResponse
     */
    public function revoke(RevokeRequest $request, string $token): JsonResponse
    {
        $currentToken = $request->getToken();

        if ($token === $currentToken) {
            return $this->response->sendForbidden(['message' => 'Unable to terminate current session.']);
        }

        $this->repository->revokeSession($token);

        return $this->response->sendOK(['message' => 'Session terminated successfully.']);
    }

    /**
     * @param RevokeAllRequest $request
     *
     * @return JsonResponse
     */
    public function revokeAll(RevokeAllRequest $request): JsonResponse
    {
        $token = $request->getToken();

        $this->repository->revokeSessions($token);

        return $this->response->sendOK(['message' => 'All other sessions terminated successfully.']);
    }
}
