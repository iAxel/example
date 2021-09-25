<?php

namespace App\Policies;

use App\Models\User;

final class UserPolicy
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

        $hasPermission = $user->hasPermission('user', 'read');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        if ($user->id === 1 && $user->email === 'owner@example.com') {
            return true;
        }

        $isAdmin = $user->hasRole('administrator');

        if ($isAdmin === true && $model->id !== 1 && $model->email !== 'owner@example.com') {
            return true;
        }

        $isModelAdmin = $model->hasRole('administrator');

        if ($isModelAdmin === true) {
            return false;
        }

        $hasPermission = $user->hasPermission('user', 'read');

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

        $hasPermission = $user->hasPermission('user', 'create');

        if ($hasPermission === true) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        if ($user->id === 1 && $user->email === 'owner@example.com') {
            return true;
        }

        $isAdmin = $user->hasRole('administrator');

        $isModelAdmin = $model->hasRole('administrator');

        if ($isAdmin === true && ($isModelAdmin === true && $user->id === $model->id || $model->id !== 1 && $model->email !== 'owner@example.com')) {
            return true;
        }

        if ($isModelAdmin === true) {
            return false;
        }

        $hasPermission = $user->hasPermission('user', 'update');

        $hasModelPermission = $model->hasPermission('user', 'update');

        if ($hasPermission === true && $hasModelPermission !== true) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->id === $model->id) {
            return false;
        }

        if ($user->id === 1 && $user->email === 'owner@example.com') {
            return true;
        }

        $isAdmin = $user->hasRole('administrator');

        $isModelAdmin = $model->hasRole('administrator');

        if ($isAdmin === true && ($isModelAdmin !== true || $model->id !== 1 && $model->email !== 'owner@example.com')) {
            return true;
        }

        if ($isModelAdmin === true) {
            return false;
        }

        $hasPermission = $user->hasPermission('user', 'delete');

        $hasModelPermission = $model->hasPermission('user', 'delete');

        if ($hasPermission === true && $hasModelPermission !== true) {
            return true;
        }

        return false;
    }
}
