<?php

namespace App\Http\Repositories\Api\Auth;

use Illuminate\Support\Facades\Auth;

final class LogoutRepository
{
    /**
     * @param string $token
     *
     * @return void
     */
    public function revokeToken(string $token): void
    {
        Auth::user()->revokeToken($token);
    }
}
