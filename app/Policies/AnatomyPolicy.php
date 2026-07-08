<?php

namespace App\Policies;

class AnatomyPolicy extends GroupPolicy
{
    protected function allowedRoles(): array
    {
        return ['anatomy_editor'];
    }
}
