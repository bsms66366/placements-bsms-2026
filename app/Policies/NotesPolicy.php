<?php

namespace App\Policies;

use App\Models\Notes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NotesPolicy
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
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Notes $notes)
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
        return true;
        //return $user->type == 'editor';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Notes $notes)
    {
        
        //return $user->type == 'Editor';
        return true;
        //return $user->id === $notes->user_id
        //? Response::allow()
        //: Response::deny('You do not own this note.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Notes $notes)
    {
        
        //return $user->type == 'Admin';
        return true;
        //return $user->id === $notes->user_id
        //? Response::allow()
        //: Response::deny('You do not own this note.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Notes $notes)
    {
        //return $user->type == 'Editor';
        return true;
        //return $user->id === $notes->user_id
        //? Response::allow()
        //: Response::deny('You do not own this note.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Notes $notes)
    {
        //return $user->type == 'Editor';
    }
}
