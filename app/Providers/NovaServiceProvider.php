<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Http\Controllers\Auth\NovaResetPasswordController;
use Laravel\Nova\Http\Controllers\ResetPasswordController;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->loadViewsFrom(resource_path('views/vendor/nova'), 'nova');
        
        // Explicitly call resources() to ensure they're registered
        $this->resources();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        $allowedRoles = explode(',', env('NOVA_ACCESS_ROLES', 'admin,supervisor'));
        
        Gate::define('viewNova', function ($user) use ($allowedRoles) {
            return $user->hasAnyRole($allowedRoles);
        });
    }
    
    protected function resources()
    {
        Nova::resources([
            // Anatomy Resources
            \App\Nova\Anatomy\Anatomy::class,
            \App\Nova\Anatomy\Dissection::class,
            \App\Nova\Anatomy\PathPots::class,
            \App\Nova\Anatomy\Spotters::class,
            \App\Nova\Anatomy\Nifti::class,
            \App\Nova\Anatomy\Dicom::class,
            \App\Nova\Anatomy\Notes::class,
            \App\Nova\Anatomy\Category::class,
            \App\Nova\Anatomy\NoteInsight::class,
            \App\Nova\Anatomy\FilteredNoteResource::class,
            \App\Nova\Anatomy\FilteredPotResource::class,
            
            // Physiology Resources
            \App\Nova\Physiology\Physquiz::class,
            \App\Nova\Physiology\Biomedeng::class,
            
            // GP/Clinical Skills Resources
            \App\Nova\GPClinicalSkills\Student::class,
            \App\Nova\GPClinicalSkills\Location::class,
            \App\Nova\GPClinicalSkills\Location2025::class,
            \App\Nova\GPClinicalSkills\LocationSignoff::class,
            \App\Nova\GPClinicalSkills\LocationCategory::class,
            \App\Nova\GPClinicalSkills\ClinicalGroup::class,
            \App\Nova\GPClinicalSkills\GPTeacher::class,
            \App\Nova\GPClinicalSkills\Facilitator::class,
            \App\Nova\GPClinicalSkills\Group::class,
            \App\Nova\GPClinicalSkills\Invitation::class,
            \App\Nova\GPClinicalSkills\MonitoredSessions2026::class,
            \App\Nova\GPClinicalSkills\SessionAttendance2026::class,
            \App\Nova\GPClinicalSkills\Workshops::class,
            \App\Nova\GPClinicalSkills\Module101::class,
            \App\Nova\GPClinicalSkills\Module102::class,
            \App\Nova\GPClinicalSkills\IAP::class,
            \App\Nova\GPClinicalSkills\Examination::class,
            \App\Nova\GPClinicalSkills\ExaminationResult::class,
            \App\Nova\GPClinicalSkills\PhaseOneStaff::class,
            \App\Nova\GPClinicalSkills\Rooms::class,
            \App\Nova\GPClinicalSkills\ExternalSite::class,
            
            // Admin Resources
            \App\Nova\Admin\User::class,
            \App\Nova\Admin\Role::class,
            
            // Shared Resources
            \App\Nova\Shared\Video::class,
            \App\Nova\Shared\Directory::class,
            \App\Nova\Shared\UserRegistration::class,
            \App\Nova\Shared\UserInsight::class,
        ]);
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Bsms\AllStudentsAttendance\AllStudentsAttendance,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResetPasswordController::class, NovaResetPasswordController::class);
    }
}
