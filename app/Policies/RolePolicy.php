<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

final class RolePolicy
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

        $hasPermission = $user->hasPermission('role', 'read');

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

        $hasPermission = $user->hasPermission('role', 'read');

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
    public function create(User $user): bool
    {
        if ($user->id === 1 && $user->email === 'owner@example.com') {
            return true;
        }

        $isAdmin = $user->hasRole('administrator');

        if ($isAdmin === true) {
            return true;
        }

        $hasPermission = $user->hasPermission('role', 'create');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function update(User $user, Role $role): bool
    {
        if ($role->slug === 'administrator') {
            return false;
        }

        $hasPermission = $user->hasPermission('role', 'update');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function delete(User $user, Role $role): bool
    {
        if ($role->slug === 'administrator') {
            return false;
        }

        $hasPermission = $user->hasPermission('role', 'delete');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }
}
