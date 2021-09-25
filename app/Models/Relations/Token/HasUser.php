<?php

namespace App\Models\Relations\Token;

use App\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }
}
