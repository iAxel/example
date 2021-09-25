<?php

namespace App\Models\Relations\Role;

use App\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasUsers
{
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id', 'id', 'id', 'users');
    }
}
