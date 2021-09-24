<?php

namespace App\Http\Middleware;

use Closure;

use App\Helpers\Response;

use App\Http\Middleware\Traits\HasGuards;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Factory;

final class Auth
{
    use HasGuards;

    /**
     * @var Factory
     */
    protected Factory $factory;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @param Factory $factory
     * @param Response $response
     *
     * @return void
     */
    public function __construct(Factory $factory, Response $response)
    {
        $this->factory = $factory;

        $this->response = $response;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @param string ...$guards
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): mixed
    {
        if ($this->hasGuards($guards) === false) {
            $guards = [null];
        }

        $isAuthCheck = false;

        foreach ($guards as $guard) {
            $isAuthCheck = $this->factory->guard($guard)->check();

            if ($isAuthCheck === false) {
                continue;
            }

            $this->factory->shouldUse($guard);
        }

        if ($isAuthCheck === false) {
            return $this->response->sendUnauthorized(['message' => 'Unauthorized.']);
        }

        return $next($request);
    }
}
