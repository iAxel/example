<?php

namespace App\Http\Repositories\Api\Profile;

use App\Models\User;

final class Repository
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function showProfile(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
        ];
    }
}
