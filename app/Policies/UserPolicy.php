<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends GroupPolicy
{
    protected function allowedRoles(): array
    {
        return ['admin'];
    }

    /**
     * @param User $loggedInUser the user trying to update the level of $model
     * @param User $model the user whose level is being updated
     */
    public function updateLevel(User $loggedInUser, User $model): bool
    {
        return $loggedInUser->hasAnyRole(['superuser', 'admin']);
    }

    /**
     * Only admins/superusers may invite new users.
     */
    public function invite(User $loggedInUser): bool
    {
        return $loggedInUser->hasAnyRole(['superuser', 'admin']);
    }
}
