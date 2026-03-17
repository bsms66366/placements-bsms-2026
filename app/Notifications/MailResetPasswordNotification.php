<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// custom
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\ResetPassword;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    protected $pageUrl;
    public $token;
    
    // Declare the static property
        protected static $toMailCallback;


    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        //$this->pageUrl = env('APP_URL', 'http://localhost:8080');
        // we can set whatever we want here, or use .env to set environmental variables
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //if (static::$toMailCallback) {
            //return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        if (static::$toMailCallback) {
                  return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        
        }

        return (new MailMessage)
                    ->subject(Lang::get('Reset Password Notification'))
                    ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
                    ->action(Lang::get('Reset Password'), url('password/reset', $this->token) . '?email=' . urlencode($notifiable->email))
                    ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
                    ->line(Lang::get('If you did not request a password reset, no further action is required.'));
            }
//            ->subject(Lang::get('Reset Application Password v1'))
//            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
//            ->action(Lang::get('Reset Password'), $this->pageUrl . "/reset-password?token=" . $this->token)
//            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
//            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    //}
/**
     * Set a callback that should be used when building the mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // Add relevant data here if needed
        ];
    }
}
