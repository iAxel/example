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

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('slug', '=', $role)->exists();
    }

    /**
     * @param string $policy
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(string $policy, string $permission): bool
    {
        $this->loadMissing([
            'roles.permissions',
            'roles.permissions.policy',
        ]);

        return $this->roles->containsStrict([
            'permissions.*.slug', $permission,
            'permissions.*.policy.slug', $policy,
        ]);
    }
}
