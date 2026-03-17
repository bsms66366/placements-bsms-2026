<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use App\Mail\InvitationEmail;
use Laravel\Nova\Fields\Email;
use App\Nova\User;

class SendPasswordResetLink extends Action
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
                $token = $model->createToken('password_reset')->plainTextToken;

                            Mail::to($model->email)->send(new InvitationEmail($token));
                        }

                        return Action::message('Emails sent');
                    }
                
//                    (new AccountData($model))->send($fields->subject);
//
//                Text::make('Subject')->default(function ($request) {
//                    return 'Test: Subject';
//                    $response = Password::sendResetLink(['email' => $model->email]);
//
//                    if ($response === Password::RESET_LINK_SENT) {
//                        // Password reset link sent successfully
//                    } else {
//                        // Handle the case when the password reset link could not be sent
//                    }
//                }

            //return Action::message('Password reset link sent!');
        //}
  

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
        Email::make('Customer Email', 'email'),
        ];
    }
}
