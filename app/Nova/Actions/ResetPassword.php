<?php

namespace App\Nova\Actions;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Email;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class ResetPassword extends Action
{
    //use InteractsWithQueue, Queueable;
    use Queueable;

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
            $newPassword = Str::random(10);
            $model->password = Hash::make($newPassword);
            $model->save();

        /* foreach ($models as $model) {
            $token = $model->createToken('password_reset')->plainTextToken;

                        Mail::to($model->email)->send(new email($token)); */
    }
    // Send email with new password
    Mail::to($model->email)->send(new ResetPasswordMail($newPassword));
    
    //return Action::message('Password reset link sent!');
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
