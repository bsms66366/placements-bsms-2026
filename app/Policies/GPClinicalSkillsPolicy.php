<?php

namespace App\Policies;

class GPClinicalSkillsPolicy extends GroupPolicy
{
    protected function allowedRoles(): array
    {
        return ['gp_editor'];
    }
}
