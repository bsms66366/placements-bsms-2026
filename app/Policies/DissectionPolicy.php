<?php

namespace App\Policies;

use App\Models\Dissection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DissectionPolicy
{
    use HandlesAuthorization;
    
//    public function before($user)
//    {
//        
//    return in_array ($user->role, ['editor', 'admin']);
//    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dissection  $dissection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Dissection $dissection)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //return $user->type == 'editor';
        return true;
        //return $this->userIsAtLeastEditor($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dissection  $dissection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Dissection $dissection)
    {
        return true;
        //return $user->type == 'editor';
        //return $user->id === $dissection->user_id
        //? Response::allow()
        //: Response::deny('You do not own this dissection video.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dissection  $dissection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Dissection $dissection)
    {
        //return $user->type == 'editor';
        return true;
        //return $user->id === $dissection->user_id
        //? Response::allow()
       // : Response::deny('You do not own this dissection video.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dissection  $dissection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Dissection $dissection)
    {
        //return $user->type == 'editor';
        return true;
       // return $user->id === $dissection->user_id
        //? Response::allow()
        //: Response::deny('You do not own this dissection video.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dissection  $dissection
     * @return \Illuminate\Auth\Access\Response|bool
     */
   public function forceDelete(User $user, Dissection $dissection)
    {
        //return $user->type == 'editor';
    }
}
