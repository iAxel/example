<?php

namespace App\Models\Relations\Policy;

use App\Models\Permission;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPermissions
{
    /**
     * @return HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'policy_id', 'id');
    }
}
