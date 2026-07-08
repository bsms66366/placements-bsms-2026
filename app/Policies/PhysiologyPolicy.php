<?php

namespace App\Policies;

class PhysiologyPolicy extends GroupPolicy
{
    protected function allowedRoles(): array
    {
        return ['physiology_editor'];
    }
}
