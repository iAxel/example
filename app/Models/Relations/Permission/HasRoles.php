<?php

namespace App\Models\Relations\Permission;

use App\Models\Role;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id', 'id', 'id', 'roles');
    }
}
