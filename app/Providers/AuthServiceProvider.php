<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Gate;
use Pktharindu\NovaPermissions\Traits\ValidatesPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

//use ValidatesPermissions;

class AuthServiceProvider extends ServiceProvider
{
    

     protected $policies = [
    
    User::class => UserPolicy::class,
//           \Pktharindu\NovaPermissions\Role::class => \App\Policies\RolePolicy::class,
      ];
    
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    //protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    //Placement::class => PlacementPolicy::class,
    //];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
    
    
}
//ResetPassword::createUrlUsing(function ($user, string $token) {
//        return 'https://placements.bsms.ac.uk/reset-password?token='.$token;
//    });
