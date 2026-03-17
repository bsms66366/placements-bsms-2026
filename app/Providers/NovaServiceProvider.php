<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use SimonHamp\LaravelNovaCsvImport\LaravelNovaCsvImport;
use Pktharindu\NovaPermissions\Traits\ValidatesPermissions;
//use App\Nova\Anatomy;

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
        
        Gate::define('viewNova', function ($user) use ($allowedRoles){
                    return in_array(optional($user->role)->name, $allowedRoles);
                     // Allow only users with specific roles
                             //return in_array(optional($user->role)->name, ['admin', 'editor','user']);
                     
                    
                     // Old email-based access list (kept for testing)
                    /*  return in_array($user->email, [
                         'cj.taylor@bsms.ac.uk',
                         'bsms6636@brighton.ac.uk',
                         'bsms6636@sussex.ac.uk',
                         'cj@taylormadeproductions.co.uk',
                         'cjtaylormade@gmail.com',
                         't.r.vincent@bsms.ac.uk',
                         'c.ingram@bsms.ac.uk',
                         'C.Hennessy@bsms.ac.uk',
                         'd.stone@bsms.ac.uk',
                         'C.F.Smith@sussex.ac.uk',
                         'c.smith@bsms.ac.uk',
                         "D.O'Brien@bsms.ac.uk",
                         'stephen.bowman1@nhs.net',
                         's.bowman@bsms.ac.uk',
                         'n.walters@bsms.ac.uk',
                         'a.dilley@bsms.ac.uk',
                         'TELHelp@bsms.ac.uk',
                         'm.koenig@bsms.ac.uk',
                         'a.ackling@bsms.ac.uk',
                         'L.Reid2@bsms.ac.uk',
                         'bsmsa2ym@bsms.ac.uk',
                         'O.Steele@bsms.ac.uk',
                         'W.Rivers@bsms.ac.uk',
                         'M.Adrain@bsms.ac.uk',
                     ]);
                    
 */
              
              
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
            //new \App\Nova\Dashboards\AnatomyInterface,
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
        
        //new DicomViewer,
                //new \Mastani\NovaPasswordReset\NovaPasswordReset,
            //new \Pktharindu\NovaPermissions\NovaPermissions(),
        //(new \Sereny\NovaPermissions\NovaPermissions())->canSee(function ($request) {
                    //return $request->user()->isSuperAdmin();
               // }),
        
            //new \Sereny\NovaPermissions\NovaPermissions(),
            //new Category,
            //new Notes,
        //new LaravelNovaCsvImport,
        //new Module102,
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
