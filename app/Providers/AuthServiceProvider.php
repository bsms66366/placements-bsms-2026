<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\AnatomyPolicy;
use App\Policies\PhysiologyPolicy;
use App\Policies\GPClinicalSkillsPolicy;
use App\Policies\SharedPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     * One policy per Nova group; shared-model resources are handled by
     * the Nova Resource.php group override rather than by policy lookup.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Admin
        \App\Models\User::class             => UserPolicy::class,
        \App\Models\Role::class             => RolePolicy::class,

        // Anatomy
        \App\Models\Anatomy::class          => AnatomyPolicy::class,
        \App\Models\Dissection::class       => AnatomyPolicy::class,
        \App\Models\PathPots::class         => AnatomyPolicy::class,
        \App\Models\Spotters::class         => AnatomyPolicy::class,
        \App\Models\Nifti::class            => AnatomyPolicy::class,
        \App\Models\Dicom::class            => AnatomyPolicy::class,
        \App\Models\Notes::class            => AnatomyPolicy::class,
        \App\Models\Category::class         => AnatomyPolicy::class,

        // Physiology
        \App\Models\Physquiz::class         => PhysiologyPolicy::class,
        \App\Models\Biomedeng::class        => PhysiologyPolicy::class,

        // GP / Clinical Skills
        \App\Models\Student::class          => GPClinicalSkillsPolicy::class,
        \App\Models\Location::class         => GPClinicalSkillsPolicy::class,
        \App\Models\Location2025::class     => GPClinicalSkillsPolicy::class,
        \App\Models\LocationSignoff::class  => GPClinicalSkillsPolicy::class,
        \App\Models\LocationCategory::class => GPClinicalSkillsPolicy::class,
        \App\Models\ClinicalGroup::class    => GPClinicalSkillsPolicy::class,
        \App\Models\GPTeacher::class        => GPClinicalSkillsPolicy::class,
        \App\Models\Facilitator::class      => GPClinicalSkillsPolicy::class,
        \App\Models\Group::class            => GPClinicalSkillsPolicy::class,
        \App\Models\Invitation::class       => GPClinicalSkillsPolicy::class,
        \App\Models\MonitoredSessions2026::class  => GPClinicalSkillsPolicy::class,
        \App\Models\SessionAttendance2026::class  => GPClinicalSkillsPolicy::class,
        \App\Models\Workshops::class        => GPClinicalSkillsPolicy::class,
        \App\Models\Module102::class        => GPClinicalSkillsPolicy::class,
        \App\Models\IAP::class              => GPClinicalSkillsPolicy::class,
        \App\Models\Examination::class      => GPClinicalSkillsPolicy::class,
        \App\Models\ExaminationResult::class => GPClinicalSkillsPolicy::class,
        \App\Models\PhaseOneStaff::class    => GPClinicalSkillsPolicy::class,
        \App\Models\Rooms::class            => GPClinicalSkillsPolicy::class,
        \App\Models\ExternalSite::class     => GPClinicalSkillsPolicy::class,

        // Shared
        \App\Models\Video::class            => SharedPolicy::class,
        \App\Models\Directory::class        => SharedPolicy::class,
        \App\Models\UserRegistration::class => SharedPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
