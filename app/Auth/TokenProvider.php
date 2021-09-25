<?php

namespace App\Auth;

use App\Models\User;
use App\Models\Token;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Contracts\Hashing\Hasher;

final class TokenProvider implements UserProvider
{
    /**
     * @var User
     */
    protected User $user;

    /**
     * @var Token
     */
    protected Token $token;

    /**
     * @var Hasher
     */
    protected Hasher $hasher;

    /**
     * @param User $user
     * @param Token $token
     * @param Hasher $hasher
     *
     * @return void
     */
    public function __construct(User $user, Token $token, Hasher $hasher)
    {
        $this->user = $user;

        $this->token = $token;

        $this->hasher = $hasher;
    }

    /**
     * @param mixed $identifier
     *
     * @return Authenticatable|null
     */
    public function retrieveById($identifier): Authenticatable|null
    {
        $user = $this->user->findById($identifier)->first();

        if ($user === null) {
            return null;
        }

        return $user;
    }

    /**
     * @param mixed $identifier
     * @param string $token
     *
     * @return Authenticatable|null
     */
    public function retrieveByToken($identifier, $token): Authenticatable|null
    {
        $model = $this->token->findByIdentifier($identifier, $token)->with('user')->first();

        if ($model === null) {
            return null;
        }

        $dateNow = Carbon::now();

        if ($dateNow > $model->expired_at) {
            return null;
        }

        $model->fill([
            'used_at' => $dateNow,
        ]);

        if ($model->save() === false) {
            return null;
        }

        return $model->user;
    }

    /**
     * @param Authenticatable $user
     * @param string $token
     *
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token): void
    {
        //
    }

    /**
     * @param array $credentials
     *
     * @return Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials): Authenticatable|null
    {
        $credentialsCount = count($credentials);

        if ($credentialsCount === 0) {
            return null;
        }

        $hasPassword = $this->hasPassword($credentials);

        if ($credentialsCount === 1 && $hasPassword === true) {
            return null;
        }

        $user = $this->user->findByCredentials($credentials)->first();

        if ($user === null) {
            return null;
        }

        return $user;
    }

    /**
     * @param Authenticatable $user
     * @param array $credentials
     *
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        return $this->hasher->check($credentials['password'], $user->getAuthPassword());
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    private function hasPassword(array $credentials): bool
    {
        $firstKey = array_key_first($credentials);

        return Str::contains($firstKey, 'password');
    }
}
