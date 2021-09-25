<?php

namespace App\Models\Relations\User;

use App\Models\Role;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id', 'id', 'id', 'roles');
    }
}
