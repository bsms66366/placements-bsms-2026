<?php

namespace App\Policies;

class SharedPolicy extends GroupPolicy
{
    protected function allowedRoles(): array
    {
        return ['shared_editor'];
    }
}
