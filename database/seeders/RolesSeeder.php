<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Seed the application's roles.
     *
     * Role → Nova group access
     * ─────────────────────────────────────────
     * superuser        → all groups (full bypass)
     * admin            → Admin group (User + Role management)
     * anatomy_editor   → Anatomy group
     * physiology_editor→ Physiology group
     * gp_editor        → GP/Clinical Skills group
     * shared_editor    → Shared group
     */
    public function run(): void
    {
        $roles = [
            'superuser',
            'admin',
            'anatomy_editor',
            'physiology_editor',
            'gp_editor',
            'shared_editor',
        ];

        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name]);
        }
    }
}
