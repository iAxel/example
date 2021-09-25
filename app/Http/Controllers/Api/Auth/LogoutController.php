<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Response;

use App\Http\Requests\Api\Auth\LogoutRequest;

use App\Http\Repositories\Api\Auth\LogoutRepository;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

final class LogoutController extends Controller
{
    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var LogoutRepository
     */
    protected LogoutRepository $repository;

    /**
     * @param Response $response
     * @param LogoutRepository $repository
     *
     * @return void
     */
    public function __construct(Response $response, LogoutRepository $repository)
    {
        $this->response = $response;

        $this->repository = $repository;

        $this->middleware('auth:api');
    }

    /**
     * @param LogoutRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(LogoutRequest $request): JsonResponse
    {
        $token = $request->getToken();

        $this->repository->revokeToken($token);

        return $this->response->sendOK(['message' => 'You have been successfully logged out.']);
    }
}
