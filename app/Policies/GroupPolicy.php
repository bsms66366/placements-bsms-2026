<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * The role names permitted to perform any action on this group.
     * Superuser is always granted via before().
     */
    abstract protected function allowedRoles(): array;

    /**
     * Superuser bypasses all permission checks unconditionally.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole('superuser')) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }

    public function view(User $user, $model): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }

    public function update(User $user, $model): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }

    public function delete(User $user, $model): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }

    public function restore(User $user, $model): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }

    public function forceDelete(User $user, $model): bool
    {
        return $user->hasAnyRole($this->allowedRoles());
    }
}
