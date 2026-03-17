<?php

namespace App\Listeners;

use App\Events\CodeGreenCreative\SamlIdp\Events\Assertion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SamlAssertionAttributes
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CodeGreenCreative\SamlIdp\Events\Assertion  $event
     * @return void
     */
    public function handle(Assertion $event)
    {
        //
    }
}
