<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\UserLevel;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
        //return $user->type == 'editor';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
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
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        //return $user->type == 'editor';
        return true;
        
//        $this->authorize('updateLevel', $user);
//
//               $validated = $request->validate([
//                   'level' => ['required', new Enum(UserLevel::class)]
//                   ]);
//
//               $user->level = $validated['level'];
//               $user->save();
//
//               return redirect(route('users.index'));
    }
    /**
     * @param User $loggedInUser the user that's trying to update the level of $model
     * @param User $model the user whose level is being updated by the $loggedInUser
     * @return bool
     */
    
   
    public function updateLevel(User $loggedInUser, User $model)
    {
      return true;
        /**
         // don't forget to import the UserLevel enum!
        return UserLevel::Administrator == $loggedInUser->level;
            if (UserLevel::Administrator == $loggedInUser->level)
         {
           // when deleting an Admin, check if there will be admins left
          if (UserLevel::Administrator == $model->level) return User::getNumberOfAdmins() > 1;
          else return true;
         }
        else return false;
     */
    }

    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //return $user->type == 'editor';
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        return true;
        //return $user->type == 'Admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
        return true;
        //return $user->type == 'Admin';
        
    }
    /**
    * Determine whether the user can invite new users.
     *
    * @param  \App\Models\User  $loggedInUser the user that's trying to invite a new user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function invite(User $loggedInUser)
   {
      //only administrators are allowed to invite new users
     return (UserLevel::Administrator == $loggedInUser->level);
     }
}
