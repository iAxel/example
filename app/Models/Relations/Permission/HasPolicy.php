<?php

namespace App\Models\Relations\Permission;

use App\Models\Policy;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasPolicy
{
    /**
     * @return BelongsTo
     */
    public function policy(): BelongsTo
    {
        return $this->belongsTo(Policy::class, 'policy_id', 'id', 'policy');
    }
}
