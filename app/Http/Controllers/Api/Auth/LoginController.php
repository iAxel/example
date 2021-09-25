<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Response;

use App\Http\Requests\Api\Auth\LoginRequest;

use App\Http\Repositories\Api\Auth\LoginRepository;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

final class LoginController extends Controller
{
    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var LoginRepository
     */
    protected LoginRepository $repository;

    /**
     * @param Response $response
     * @param LoginRepository $repository
     *
     * @return void
     */
    public function __construct(Response $response, LoginRepository $repository)
    {
        $this->response = $response;

        $this->repository = $repository;

        $this->middleware('guest');
    }

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->getCredentials();

        $attempt = $this->repository->attempt($credentials);

        if ($attempt === false) {
            return $this->response->sendUnauthorized(['message' => 'These credentials do not match our records.']);
        }

        $user = $request->user();

        $userData = $request->userData();

        $token = $this->repository->createToken($user, $userData);

        return $this->response->sendOK($token);
    }
}
