<?php

namespace App\Mail;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $invitation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        //
        //public User $user,
        $this->invitation = $invitation;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('anatomy@bsms.ac.uk', 'Anatomy'),
            subject: 'Reset password',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
      $this->subject('Invitation')
       ->from(env('MAIL_FROM_ADDRESS','anatomy@bsms.ac.uk'))
       ->markdown('email.invitation')
      ->with(['name'  => $this->invitation->fullname,
              'email_content' => $this->invitation->email_content,
           //view: 'views.emails.passwordReset.blade.php',
           //html: 'emails.orders.shipped',
          //text: 'emails.orders.shipped',
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
