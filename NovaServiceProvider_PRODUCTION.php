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
            // Anatomy Resources - FLAT NAMESPACE FOR PRODUCTION
            \App\Nova\Anatomy::class,
            \App\Nova\Dissection::class,
            \App\Nova\PathPots::class,
            \App\Nova\Spotters::class,
            \App\Nova\Nifti::class,
            \App\Nova\Dicom::class,
            \App\Nova\Notes::class,
            \App\Nova\Category::class,
            \App\Nova\NoteInsight::class,
            \App\Nova\FilteredNoteResource::class,
            \App\Nova\FilteredPotResource::class,
            
            // Physiology Resources - FLAT NAMESPACE FOR PRODUCTION
            \App\Nova\Physquiz::class,
            \App\Nova\Biomedeng::class,
            
            // GP/Clinical Skills Resources - FLAT NAMESPACE FOR PRODUCTION
            \App\Nova\Student::class,
            \App\Nova\Location::class,
            \App\Nova\Location2025::class,
            \App\Nova\LocationSignoff::class,
            \App\Nova\LocationCategory::class,
            \App\Nova\ClinicalGroup::class,
            \App\Nova\GPTeacher::class,
            \App\Nova\Facilitator::class,
            \App\Nova\Group::class,
            \App\Nova\Invitation::class,
            \App\Nova\MonitoredSessions2026::class,
            \App\Nova\SessionAttendance2026::class,
            \App\Nova\Workshops::class,
            \App\Nova\Module101::class,
            \App\Nova\Module102::class,
            \App\Nova\IAP::class,
            \App\Nova\Examination::class,
            \App\Nova\ExaminationResult::class,
            \App\Nova\PhaseOneStaff::class,
            \App\Nova\Rooms::class,
            \App\Nova\ExternalSite::class,
            
            // Admin Resources - FLAT NAMESPACE FOR PRODUCTION
            \App\Nova\User::class,
            \App\Nova\Role::class,
            
            // Shared Resources - FLAT NAMESPACE FOR PRODUCTION
            \App\Nova\Video::class,
            \App\Nova\Directory::class,
            \App\Nova\UserRegistration::class,
            \App\Nova\UserInsight::class,
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
