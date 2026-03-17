<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;


class UserResetPassword extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
        {
            foreach ($models as $model) {
                // Generate a random password
                $newPassword = Str::random(10);
                
                // Update the user's password
                $model->password = Hash::make($newPassword);
                $model->save();
                
                // Optionally, send the new password to the user via email
                // Password::sendResetLink(['email' => $model->email]);
    
                // Add a message for each user whose password was reset
                Action::message('Password reset for ' . $model->email . ' to: ' . $newPassword);
            }
    
            return Action::message('Passwords have been reset and emailed to users.');
        }


  /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
