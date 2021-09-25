<?php

namespace App\Auth;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Auth\AuthenticationException;

final class TokenGuard implements Guard
{
    /**
     * @var Authenticatable|null
     */
    protected Authenticatable|null $user;

    /**
     * @var UserProvider
     */
    protected UserProvider $provider;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var string
     */
    protected string $tokenKey;

    /**
     * @param UserProvider $provider
     * @param Request $request
     * @param array $config
     *
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request, array $config = [])
    {
        $this->user = null;

        $this->provider = $provider;

        $this->request = $request;

        $this->tokenKey = $config['token_key'] ?? 'access_token';
    }

    /**
     * @return Authenticatable
     *
     * @throws AuthenticationException
     */
    public function authenticate(): Authenticatable
    {
        $user = $this->user();

        if ($user !== null) {
            return $user;
        }

        throw new AuthenticationException;
    }

    /**
     * @return bool
     */
    public function hasUser(): bool
    {
        return $this->user !== null;
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return bool
     */
    public function guest(): bool
    {
        return $this->user() === null;
    }

    /**
     * @return Authenticatable|null
     */
    public function user(): Authenticatable|null
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $token = $this->getTokenForRequest();

        if ($token === null) {
            return null;
        }

        $user = $this->user = $this->provider->retrieveByToken($this->tokenKey, $token);

        $this->setUser($user);

        return $this->user;
    }

    /**
     * @return int|string|null
     */
    public function id(): int|string|null
    {
        $user = $this->user();

        if ($user !== null) {
            return $user->getAuthIdentifier();
        }

        return null;
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function validate(array $credentials = []): bool
    {
        $user = $this->provider->retrieveByCredentials($credentials);

        if ($user === null) {
            return false;
        }

        $validated = $this->provider->validateCredentials($user, $credentials);

        if ($validated === false) {
            return false;
        }

        $this->setUser($user);

        return true;
    }

    /**
     * @return UserProvider
     */
    public function getProvider(): UserProvider
    {
        return $this->provider;
    }

    /**
     * @param Authenticatable $user
     *
     * @return void
     */
    public function setUser(Authenticatable $user): void
    {
        $this->user = $user;
    }

    /**
     * @param UserProvider $provider
     *
     * @return void
     */
    public function setProvider(UserProvider $provider): void
    {
        $this->provider = $provider;
    }

    /**
     * @return string|null
     */
    private function getTokenForRequest(): string|null
    {
        $token = $this->request->bearerToken();

        if ($token === null) {
            $token = $this->request->query($this->tokenKey);
        }

        if ($token === null) {
            $token = $this->request->input($this->tokenKey);
        }

        return $token;
    }
}
