<?php

namespace App\Http\Requests\Traits;

trait HasToken
{
    /**
     * @var string
     */
    protected string $tokenKey = 'access_token';

    /**
     * @return string
     */
    public function getToken(): string
    {
        $token = $this->bearerToken();

        if ($token === null) {
            $token = $this->query($this->tokenKey);
        }

        if ($token === null) {
            $token = $this->input($this->tokenKey);
        }

        return $token;
    }
}
