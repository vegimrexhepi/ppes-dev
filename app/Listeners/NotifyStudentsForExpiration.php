<?php

namespace ppes\Listeners;

use ppes\Events\StudentEvaluationExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyStudentsForExpiration
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
     * @param  StudentEvaluationExpired  $event
     * @return void
     */
    public function handle()
    {
        //
    }
}
