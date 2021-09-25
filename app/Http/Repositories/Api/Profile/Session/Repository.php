<?php

namespace App\Http\Repositories\Api\Profile\Session;

use App\Models\User;
use App\Models\Token;

use Jenssegers\Agent\Agent;

use Illuminate\Support\Facades\Auth;

final class Repository
{
    /**
     * @param string $token
     *
     * @return array
     */
    public function getSessions(string $token): array
    {
        $sessions = $this->user()->tokens()->orderBy('used_at', 'desc')->get();

        $result = $sessions->map(function (Token $session) use ($token) {
            return [
                'token' => $session->access_token,
                'agent' => $this->userAgent($session->user_agent),
                'is_current' => $session->access_token === $token,
                'ip_address' => $session->user_ip,
                'last_active' => $session->used_at->diffForHumans(),
            ];
        });

        return $result->all();
    }

    /**
     * @param string $token
     *
     * @return void
     */
    public function revokeSession(string $token): void
    {
        $this->user()->revokeToken($token);
    }

    /**
     * @param string $token
     *
     * @return void
     */
    public function revokeSessions(string $token): void
    {
        $this->user()->revokeTokens($token);
    }

    /**
     * @return User
     */
    private function user(): User
    {
        return Auth::user();
    }

    /**
     * @param string $user_agent
     *
     * @return array
     */
    private function userAgent(string $user_agent): array
    {
        $agent = new Agent();

        $agent->setUserAgent($user_agent);

        return [
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
        ];
    }
}
