<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

//use Illuminate\Support\ServiceProvider;
use App\Observers\InvitationObserver;
use App\Models\Invitation;
use App\Models\User;
use App\Policies\UserPolicy;

use App\Models\Notes;
use App\Policies\NotesPolicy;

use App\Models\Dissection;
use App\Policies\DissectionPolicy;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;



class AppServiceProvider extends ServiceProvider
{
    /**
         * The policy mappings for the application.
         *
         * @var array
         */
        protected $policies = [
            User::class => UserPolicy::class,
            Notes::class => NotesPolicy::class,
            Dissection::class => DissectionPolicy::class,
        ];
     
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->registerPolicies();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Invitation::observe(InvitationObserver::class);
         $this->registerPolicies();
        /*  $this->routes(function () {
             Route::prefix('api')
               ->middleware('api')
               ->namespace($this->namespace)
               ->group(base_path('routes/api.php'));
           }*/
        
        //Schema::defaultStringLength(191);
        Invitation::observe(InvitationObserver::class);
    }
}
