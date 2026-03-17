<?php

namespace App\Observers;

use App\Models\Invitation;
use App\Mail\InvitationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InvitationObserver
{
    /**
         * Handle the invitation "created" event.
         *
         * @param  \App\Invitation  $invitation
         * @return void
         */
        public function created(Invitation $invitation)
        {
            Log::stack(['single'])->info('Sending email invitation to '. $invitation->email);
            Mail::to($invitation->email)->queue(new InvitationEmail($invitation));
        }
}
