<?php

namespace App\Http\Repositories\Api\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

final class LoginRepository
{
    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function attempt(array $credentials): bool
    {
        return Auth::validate($credentials);
    }

    /**
     * @param User $user
     * @param array $attributes
     *
     * @return array
     */
    public function createToken(User $user, array $attributes): array
    {
        $token = $user->createToken($attributes);

        return [
            'access_token' => $token->access_token,
            'refresh_token' => $token->refresh_token,
            'expired_at' => $token->expired_at,
        ];
    }
}
