<?php

namespace App\Policies;

use App\Models\User;

final class PolicyPolicy
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        if ($user->id === 1 && $user->email === 'owner@example.com') {
            return true;
        }

        $isAdmin = $user->hasRole('administrator');

        if ($isAdmin === true) {
            return true;
        }

        $hasPermission = $user->hasPermission('policy', 'read');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
        if ($user->id === 1 && $user->email === 'owner@example.com') {
            return true;
        }

        $isAdmin = $user->hasRole('administrator');

        if ($isAdmin === true) {
            return true;
        }

        $hasPermission = $user->hasPermission('policy', 'read');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }
}
