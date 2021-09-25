<?php

namespace App\Models\Relations\User;

use App\Models\Token;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTokens
{
    /**
     * @return HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class, 'user_id', 'id');
    }

    /**
     * @param array $attributes
     *
     * @return Token
     */
    public function createToken(array $attributes): Token
    {
        return $this->tokens()->create($attributes);
    }

    /**
     * @param string $access_token
     *
     * @return void
     */
    public function revokeToken(string $access_token): void
    {
        $this->tokens()->where('access_token', '=', $access_token)->delete();
    }

    /**
     * @param string $access_token
     *
     * @return void
     */
    public function revokeTokens(string $access_token): void
    {
        $this->tokens()->where('access_token', '!=', $access_token)->delete();
    }
}
