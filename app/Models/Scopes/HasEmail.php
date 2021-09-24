<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;

trait HasEmail
{
    /**
     * @param string $email
     *
     * @return Model|null
     */
    public function findByEmail(string $email): Model|null
    {
        return $this->newQuery()->where('email', '=', $email)->first();
    }
}
