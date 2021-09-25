<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\Request;

final class LoginRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function userData(): array
    {
        return [
            'user_ip' => $this->getClientIp(),
            'user_agent' => $this->userAgent(),
        ];
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->only([
            'email',
            'password',
        ]);
    }
}
